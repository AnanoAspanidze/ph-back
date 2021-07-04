<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Course;
use App\Models\CourseDetail;

class CourseController extends Controller
{
    private $topic;
    private $course;
    private $courseDetail;
    
    public function __construct(Topic $topic, Course $course, CourseDetail $courseDetail)
    {
        $this->topic = $topic;
        $this->course = $course;
        $this->courseDetail = $courseDetail;
        $this->middleware('auth');
    }
    
    private function getAccesableParts($course, $finishedParts) {
        $resp = [];
        
        foreach($course->parts as $part) {
            if( in_array($part->id, $finishedParts) ) {
                $resp[] = $part->id;
            }else {
                $resp[] = $part->id;
                break;
            }
        }

        return $resp;
    }

    public function inner($id, $page = null)
    {
        try {

            $layout = 'intro';
            $course = $this->course
                ->withCount('courseDetail')
                ->with([
                    'courseDetail' => function($q) {
                        return $q->where('user_id', auth()->id());
                    },
                    'parts' => function($q) use ($page) {
                        return $q->where('active', true)->orderBy('sort', 'asc');
                    },
                    'topic' => function($q) {
                        return $q->select('id')->withTranslation('title', 'tags');
                    } 
                ])
                ->findOrFail($id);

            $finishedParts = null;
            $currentPart = null;
            
            if(count($course->courseDetail) > 0) {
                $layout = 'part';
                $finishedParts = json_decode($course->courseDetail->first()->parts, true) ?? [];
                $accesableParts = $this->getAccesableParts($course, $finishedParts);

                if($page && in_array($page, $accesableParts)) {
                    $currentPart = $course->parts->where('id', $page)->first();
                }else {
                    if($page) return redirect()->back();
                    $currentPart = $course->parts->where('id', $accesableParts[0])->first();
                }

            }else {
                $course->update([
                    'views' => $course->views + 1
                ]);
            }

            return view('web.frontend.sections.course.inner', compact('course', 'layout', 'currentPart', 'finishedParts'));
        }catch (\Throwable $e) {
            abort('404');
        }
    }
   
    public function start(Request $request, $id)
    {
        try {
            $course = $this->course
                ->whereHas(
                    'parts', function($q) {
                        return $q->where('active', true);
                    }
                )
                ->whereDoesntHave('courseDetail', function($q) {
                    return $q->where('user_id', auth()->id());
                })
                ->where('id', $id)
                ->where('active', true)
                ->first();

            if(!$course) {
                return redirect()->back();
            }

            $course->courseDetail()->create([
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('course.inner', [$course->id, $course->parts->first()->id]);
        }catch (\Throwable $e) {
            abort(404);
        }
    }

    public function next(Request $request)
    {
        try {
            if($course_id = $request->course_id && $part_id = $request->part_id) {
                $course = $this->course
                    ->where('active', true)
                    ->with([
                        'courseDetail' => function($q) {
                            return $q->where('user_id', auth()->id());
                        },
                        'parts'
                    ])
                    ->findOrFail($course_id);

                $courseDetail = $course->courseDetail->first();
                $finishedParts = json_decode($courseDetail->parts, true) ?? [];
                                
                if(!$course || in_array($part_id, $finishedParts)) {
                    return redirect()->back();
                }

                $finishedParts[] = (int)$part_id;

                $course->courseDetail->first()->update([
                    'parts' => json_encode($finishedParts)
                ]);
                
                $currentPart = $course->parts->find($part_id);
                $next = $course->parts->where('sort', '>', $currentPart->sort)->first();
                
                if(!$next) {
                    return redirect()->back();
                }
                
                return redirect()->route('course.inner', [$course->id, $next->id]);

            }else { 
                return redirect()->back();
            }

        }catch (\Throwable $e) {
            abort(404);
        }
    }
}
