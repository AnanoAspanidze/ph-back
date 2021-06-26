<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StepPageRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Resource;
use App\Models\Language;
use App\Models\Step;
use App\Models\Topic;

class StepPageController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $step;
    private $language;
    private $resource;

    public function __construct( Resource $resource, Topic $topic, Step $step, Language $language ) {
        $this->topic = $topic;
        $this->step = $step;
        $this->resource = $resource;
        $this->language = $language;
    }

    public function create(Request $request, $topic_id) {
        $languages = $this->language->get();
        $topic = $this->topic->select('id', 'illustration')->findOrFail($topic_id);
        return view('web.backend.sections.studentResources.step.add', compact('topic', 'languages'));
    }

    public function store(StepPageRequest $request, $topic_id) {
        try{
        
            $data = $request->except('_token');
            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/step');
            }

            $intro = $this->step->create($data);
            $intro->resource()->create([
                'topic_id' => $topic_id,
                'show_steps' => false,
                'layout' => null,
                'sort' => 0,
                'parent' => 0,
                'active' => true
            ]);

            return redirect()->route('student_resources.resources', $topic_id)->with('success','ნაბიჯი წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','ნაბიჯის დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $step = $this->step->with('resource.explanations')->findOrFail($id);
        return view('web.backend.sections.studentResources.step.edit', compact('step', 'languages'));
    }

    public function update(StepPageRequest $request, $id) {
        try{
            $data = $request->except('_token');
            $step = $this->step->with('resource')->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $this->deleteFile('storage/pages/step/', $step->illustration);
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/step');
            }

            $step->update($data);

            return redirect()->route('student_resources.resources', $step->resource->topic_id)->with('success','ნაბიჯი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','ნაბიჯის განახლება ვერ მოხერხდა');
        }
    }
}
