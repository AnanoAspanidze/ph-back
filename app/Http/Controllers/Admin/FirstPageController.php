<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FirstPageRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Resource;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Intro;

class FirstPageController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $intro;
    private $language;
    private $resource;

    public function __construct( Resource $resource, Topic $topic, Intro $intro, Language $language ) {
        $this->topic = $topic;
        $this->intro = $intro;
        $this->resource = $resource;
        $this->language = $language;
    }

    public function create(Request $request, $topic_id) {
        $languages = $this->language->get();

        $topic = $this->topic->select('id', 'illustration')->with(['resources' => function($query) {
            return $query->where('resourceable_type', 'App\Models\Step')->with('resourceable', 'children');
        }])->findOrFail($topic_id);

        return view('web.backend.sections.studentResources.intro.add', compact('topic', 'languages'));
    }

    public function store(FirstPageRequest $request, $topic_id) {
        try{

            $data = $request->except('_token');
            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/intro');
            }

            $intro = $this->intro->create($data);
            $intro->resource()->create([
                'topic_id' => $topic_id,
                'show_steps' => false,
                'layout' => null,
                'sort' => 0,
                'parent' => 0,
                'active' => true
            ]);

            return redirect()->route('student_resources.resources', $topic_id)->with('success','პირველი გვერდი წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','პირველი გვერდის დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $intro = $this->intro->with('resource.explanations')->findOrFail($id);
        return view('web.backend.sections.studentResources.intro.edit', compact('intro', 'languages'));
    }

    public function update(FirstPageRequest $request, $id) {
        try{
            $data = $request->except('_token');
            $intro = $this->intro->with('resource')->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $this->deleteFile('storage/pages/intro/', $intro->illustration);
                $data['illustration'] = \FileUpload::run($request->illustration, 'pages/intro');
            }

            $intro->update($data);

            return redirect()->route('student_resources.resources', $intro->resource->topic_id)->with('success','პირველი გვერდი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','პირველი გვერდის განახლება ვერ მოხერხდა');
        }
    }
}
