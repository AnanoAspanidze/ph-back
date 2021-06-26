<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CurseRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Course;

class TeacherResourcesController extends Controller
{
    private $topic;
    private $language;
    private $course;

    public function __construct( Topic $topic, Language $language, Course $course ) {
        $this->topic = $topic;
        $this->language = $language;
        $this->course = $course;
        app()->setLocale('ka');
    }

    public function index(Request $request) {
        $topics = $this->topic
            ->whereHas('course')
            ->with('course')
            ->select('id', 'illustration')
            ->get();

        return view('web.backend.sections.teacherResources.index', compact('topics'));
    }

    // Course Actions Begin
    public function create(Request $request) {

        $languages = $this->language->get();
        $topics = $this->topic
            ->doesntHave('course')
            ->where('active', true)
            ->get();
        
        return view('web.backend.sections.teacherResources.course.add', compact('topics', 'languages'));
    }

    public function store(CurseRequest $request) {
        try{

            $data = $request->except('_token');

            if(isset($data['topic_id']) && $this->topic->whereHas('course')->find($data['topic_id'])) {
                throw new Exception();
            }

            $course = $this->course->create($data);

            return redirect()->route('teacher_resources.course', $course->id)->with('success','კურსი წარმატებით დაემატა');
        } catch (\Throwable $e) {
            return back()->with('error','კურსის დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();

        $topics = $this->topic
            ->where('active', true)
            ->get();
            
        $course = $this->course->with([
                'topic' => function($q) {
                    return $q->select('id');
                }
            ])->findOrFail($id);

        return view('web.backend.sections.teacherResources.course.edit', compact('course', 'languages', 'topics'));
    }

    public function update(CurseRequest $request, $id) {

        try{
            
            $data = $request->except('_token', 'topic_id');
            $data['active'] = (isset($data['active']) && $data['active'] == 'on') ? true : false;

            $course = $this->course
                ->findOrFail($id)
                ->update($data);

            return redirect()->route('teacher_resources.course', $id)->with('success','კურსი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','კურსის განახლება ვერ მოხერხდა');
        }
        
    }
    // Course Actions End

    public function course($id) {
        try {

            $course = $this->course
                ->with([
                    'topic' => function($q) {
                        return $q->select('id', 'illustration');
                    }
                ])
                ->findOrFail($id);

            return view('web.backend.sections.teacherResources.course', compact('course'));
        } catch (\Throwable $e) {
            return back()->with('error','მოცემული გვერდი არ არსებობს');
        }
    }

    public function sortParts(Request $request) {
        $messages = [
            'success' => "Data Sorted Successfully",
            'error' => "Can't sort data"
        ];
        return $this->safeResponse(function() use ($request) {
            $array = $request->input('orderArr');
            $this->resource->rearrange($array);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }

    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "გვერდი გაქტიურდა" : "გვერდი წარმატებით დიაქტივირებულია",
            'error' => "გვერდის გააქტიურება ვერ მოხერხდა"
        ];
        return $this->safeResponse(function() use ($request, $id) {
            $this->resource->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
