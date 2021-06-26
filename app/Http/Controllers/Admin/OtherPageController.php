<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OtherPageRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Resource;
use App\Models\Language;
use App\Models\Other;
use App\Models\Topic;

class OtherPageController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $other;
    private $language;
    private $resource;

    public function __construct( Resource $resource, Topic $topic, Other $other, Language $language ) {
        $this->topic = $topic;
        $this->other = $other;
        $this->resource = $resource;
        $this->language = $language;
        app()->setLocale('ka');
    }

    public function create(Request $request, $topic_id) {
        $languages = $this->language->get();
        $topic = $this->topic->select('id', 'illustration')->with(['resources' => function($query) {
            return $query->where('resourceable_type', 'App\Models\Step')->with('resourceable', 'children.resourceable');
        }])->findOrFail($topic_id);
        
        return view('web.backend.sections.studentResources.other.add', compact('topic', 'languages'));
    }

    public function store(OtherPageRequest $request, $topic_id) {
        try{
            $data = $request->except('_token');

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/other');
            }

            $other = $this->other->create($data);
            
            if(isset($data['resources']['parent'])) {
                $childrens = $this->resource->where('id', $data['resources']['parent'])
                    ->with(['children' => function($q) use ($data) {
                        return $q->where('sort', '>', ($data['resources']['sort'] ?? 0)); 
                }])->first()->children;
                foreach($childrens as $children) {
                    $children->update(['sort' => ($children->sort + 1 )]);
                }
            }
            $data['resources']['parent'] = $data['resources']['parent'] ?? 0;
            $data['resources']['show_steps'] = (isset($data['resources']['show_steps']) && $data['resources']['show_steps'] == 'on') ? true : false;
            $data['resources']['topic_id'] = $topic_id;
            $data['resources']['active'] = true;
            $other->resource()->create($data['resources']);

            return redirect()->route('student_resources.resources', $topic_id)->with('success','გვერდი წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','გვერდის დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $other = $this->other->with('resource.explanations')->findOrFail($id);
        return view('web.backend.sections.studentResources.other.edit', compact('other', 'languages'));
    }

    public function update(OtherPageRequest $request, $id) {
        try{
            
            $data = $request->except('_token');
            $other = $this->other->with('resource')->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                if($other->illustration) {
                    $this->deleteFile('storage/pages/other/', $other->illustration);
                }
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/other');
            }

            $data['resources']['show_steps'] = (isset($data['resources']['show_steps']) && $data['resources']['show_steps'] == 'on') ? true : false;
            $other->resource->update($data['resources']);
            $other->update($data);

            return redirect()->route('student_resources.resources', $other->resource->topic_id)->with('success','გვერდი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','გვერდის განახლება ვერ მოხერხდა');
        }
    }
}
