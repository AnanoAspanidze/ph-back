<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CurseRequest;
use App\Http\Traits\SafeResponse;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Course;
use App\Models\Part;

class TeacherResourcesController extends Controller
{
    use SafeResponse;

    private $topic;
    private $language;
    private $course;
    private $part;

    public function __construct( Topic $topic, Language $language, Course $course, Part $part ) {
        $this->topic = $topic;
        $this->language = $language;
        $this->course = $course;
        $this->part = $part;
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
                    'parts' => function($q) {
                        return $q->orderBy('sort','ASC');
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
            $parts = $this->part->where('course_id', $request->input('id'));
            $count = 0;
            foreach($array as $a) {
                $count++;
                $this->part->where('id', $a['id'])->update(['sort' => $count]);
            }
            
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
