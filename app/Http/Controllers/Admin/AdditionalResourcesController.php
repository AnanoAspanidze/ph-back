<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PageAdditionalRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\PageAdditional;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Resource;
use Illuminate\Support\Str;

class AdditionalResourcesController extends Controller
{
    use SafeResponse, Helper;

    private $pageAdditional;
    private $language;
    private $topic;
    private $resource;

    public function __construct( PageAdditional $pageAdditional, Topic $topic, Language $language, Resource $resource ) {
        $this->pageAdditional = $pageAdditional;
        $this->language = $language;
        $this->topic = $topic;
        $this->resource = $resource;
        app()->setLocale('ka');
    }

    public function index(Request $request) {
        $additionalResources = $this->pageAdditional->with('topic')->select('id', 'type', 'pdf', 'video', 'image', 'pinned', 'direction', 'active', 'link', 'topic_id')->get();
        return view('web.backend.sections.additionalResources.index', compact('additionalResources'));
    }    
    
    public function create(Request $request) {
        $languages = $this->language->get();
        $topics = $this->topic->with(['resources' => function($q) {
            return $q->where('active', true)->select('id', 'topic_id');
        }])->where('active', true)->select('id')->get();
        
        return view('web.backend.sections.additionalResources.add', compact('languages', 'topics'));
    }

    public function store(PageAdditionalRequest $request) {
        try{

            $data = $request->except('_token');
            if(isset($data['image']) && file_exists($data['image'])){
                $data['image'] = \FileUpload::run($request->image, 'additional/images');
            }
            if(isset($data['pdf']) && file_exists($data['pdf'])){
                $data['pdf'] = \FileUpload::run($request->pdf, 'additional/files', false);
            }
            $data['pinned'] =  (isset($data['pinned']) && $data['pinned'] == 'on') ? true : false;
            $this->pageAdditional->create($data);

            return redirect()->route('additional_resources.index')->with('success','დამატებითი რესურსი წარმატებით დაემატა');
        } catch (\Throwable $e) {
            return back()->with('error','დამატებითი რესურსის დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $topics = $this->topic->with(['resources' => function($q) {
            return $q->where('active', true)->select('id', 'topic_id', 'resourceable_type', 'resourceable_id')->with('resourceable');
        }])->where('active', true)->select('id')->get();
        $pageAdditional = $this->pageAdditional->with('topic')->select('id', 'type', 'sub_type', 'pdf', 'video', 'image', 'pinned', 'direction', 'active', 'link', 'topic_id', 'resource_id')->findOrFail($id);
        $topic = $topics->where('id', $pageAdditional->topic_id)->first();
        $resources = $topic->resources ?? [];
        return view('web.backend.sections.additionalResources.edit', compact('pageAdditional', 'topics', 'languages', 'resources'));
    }

    public function update(PageAdditionalRequest $request, $id) {
        try{
            $data = $request->except('_token');
            $pageAdditional = $this->pageAdditional->findOrFail($id);

            if( isset($data['image']) && file_exists($data['image'])){
                $this->deleteFile('storage/additional/images/', $pageAdditional->image);
                $data['image'] = \FileUpload::run($request->image, 'additional/images');
            }

            if( isset($data['pdf']) && file_exists($data['pdf'])){
                if(file_exists('storage/additional/files/'.$pageAdditional->pdf)) {
                    unlink('storage/additional/files/'.$pageAdditional->pdf);
                }
                $data['pdf'] = \FileUpload::run($request->pdf, 'additional/files', false);
            }

            $data['pinned'] =  (isset($data['pinned']) && $data['pinned'] == 'on') ? true : false;
            $pageAdditional->update($data);

            return redirect()->route('additional_resources.index')->with('success','დამატებითი რესურსი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','დამატებითი რესურსის განახლება ვერ მოხერხდა');   
        }
    }


    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "დამატებითი რესურსი წარმატებით გაქტიურდა" : "დამატებითი რესურსი წარმატებით დიაქტივირებულია",
            'error' => "დამატებითი რესურსი გააქტიურება ვერ მოხერხდა"
        ];

        return $this->safeResponse(function() use ($request, $id) {
            $this->pageAdditional->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }

    public function getPages(Request $request) {
        try {
            $resources = $this->resource
                ->select('id', 'active', 'topic_id', 'resourceable_id', 'resourceable_type', 'parent')
                ->with('resourceable')
                ->where('active', true)
                ->where('topic_id', $request->topic_id)
                ->get();

            $resp = [];
            foreach($resources as $resource) {
                if($resource->resourceable) {

                    $type = config('resourceable.'.class_basename($resource->resourceable_type))['type'];
                    
                    if(class_basename($resource->resourceable_type) === 'Other') {
                        $type = $resource->parent ? 'მსჯელობა' : 'კომპლექსური დავალება';
                    }

                    $resp[] = [
                        'id' => $resource->id,
                        'title' => $type.' - '.Str::limit(($resource->resourceable->title ?? $resource->resourceable->sub_title), 50)
                    ];
                }
            }

            return response()->json(['pages' => $resp]);
        }catch (\Throwable $e) {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $messages = [
            'success' => "დამატებითი რესურსი წარმატებით წაიშალა",
            'error' => "დამატებითი რესურსის წაშლა ვერ მოხერხდა"
        ];

        return $this->safeResponse(function() use ($id) {            
            $pageAdditional = $this->pageAdditional->findOrFail($id);
    
            if($pageAdditional->image)
                $this->deleteFile('storage/additional/images/', $pageAdditional->image);            

            if( $pageAdditional->pdf && file_exists('storage/additional/files/'.$pageAdditional->pdf)) {
                unlink('storage/additional/files/'.$pageAdditional->pdf);
            }
            
            $pageAdditional->delete();

            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
