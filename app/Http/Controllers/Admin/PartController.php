<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PartRequest;
use App\Http\Traits\SafeResponse;
use App\Models\Course;
use App\Models\Part;
use App\Models\Language;

class PartController extends Controller
{
    use SafeResponse;

    private $course;
    private $part;
    private $language;

    public function __construct( Course $course, Part $part, Language $language ) {
        $this->course = $course;
        $this->part = $part;
        $this->language = $language;
        app()->setLocale('ka');
    }

    public function create(Request $request, $course_id) {
        $languages = $this->language->get();
        $course = $this->course
            ->select('id')
            ->with([
                'parts' => function($q) {
                    return $q->select('id', 'course_id');
                }
            ])->findOrFail($course_id);
        
        return view('web.backend.sections.teacherResources.part.add', compact('course', 'languages'));
    }

    public function store(PartRequest $request, $course_id) {
        try{

            $data = $request->except('_token');
            $course = $this->course
            ->with([
                'parts' => function($q) use ($data){
                    return $q->where('sort', '>', ($data['sort'] ?? 0));
                }
            ])
            ->findOrFail($course_id);

            if(isset($data['sort'])) {
                $data['sort'] = + 1;

                $newSort = 0;
                foreach($course->parts as $part) {
                    $newSort = $part->sort + 1;
                    $part->update(['sort' => $newSort]);
                }
            }

            $course->parts()->create($data);

            return redirect()->route('teacher_resources.course', $course_id)->with('success','ნაწილი წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','ნაწილის დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $part = $this->part->findOrFail($id);
        return view('web.backend.sections.teacherResources.part.edit', compact('part', 'languages'));
    }

    public function update(PartRequest $request, $id) {
        try{
            
            $data = $request->except('_token');
            $part = $this->part->findOrFail($id);
            $part->update($data);

            return redirect()->route('teacher_resources.course', $part->course_id)->with('success','ნაწილი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','ნაწილის განახლება ვერ მოხერხდა');
        }
    }
    
    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "ნაწილი წარმატებით გაქტიურდა" : "ნაწილი წარმატებით დიაქტივირებულია",
            'error' => "ნაწილის გააქტიურება ვერ მოხერხდა"
        ];
        
        return $this->safeResponse(function() use ($request, $id) {
            $this->part->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
