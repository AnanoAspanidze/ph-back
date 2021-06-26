<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExplanationPageRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Resource;
use App\Models\Language;
use App\Models\Explanation;
use App\Models\Topic;

class ExplanationPageController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $explanation;
    private $language;
    private $resource;

    public function __construct( Resource $resource, Topic $topic, Explanation $explanation, Language $language ) {
        $this->topic = $topic;
        $this->explanation = $explanation;
        $this->resource = $resource;
        $this->language = $language;
        app()->setLocale('ka');
    }

    public function create(Request $request, $resource_id) {
        $languages = $this->language->get();
        return view('web.backend.sections.studentResources.explanation.add', compact('resource_id', 'languages'));
    }

    public function store(ExplanationPageRequest $request, $resource_id) {
        try{

            $data = $request->except('_token');

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/explanation');
            }
            
            $data['show_steps'] = (isset($data['show_steps']) && $data['show_steps'] == 'on') ? true : false;
            $data['resource_id'] = $resource_id;
            
            $explanation = $this->explanation->create($data);
            
            return back()->with('success','განმარტება წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','განმარტების დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $explanation = $this->explanation->findOrFail($id);
        return view('web.backend.sections.studentResources.explanation.edit', compact('explanation', 'languages'));
    }

    public function update(ExplanationPageRequest $request, $id) {
        try{
            $data = $request->except('_token');
            $explanation = $this->explanation->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                if($explanation->illustration) {
                    $this->deleteFile('storage/pages/explanation/', $explanation->illustration);
                }
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/explanation');
            }
            $data['show_steps'] = (isset($data['show_steps']) && $data['show_steps'] == 'on') ? true : false;
            $explanation->update($data);

            return back()->with('success','განმარტება წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','განმარტების განახლება ვერ მოხერხდა');
        }
    }

    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "განმარტება წარმატებით გაქტიურდა" : "განმარტება წარმატებით დიაქტივირებულია",
            'error' => "განმარტების გააქტიურება ვერ მოხერხდა"
        ];
        return $this->safeResponse(function() use ($request, $id) {
            $this->explanation->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
