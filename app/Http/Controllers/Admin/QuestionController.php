<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Language;
use App\Models\Part;
use App\Models\Course;
use App\Models\Question;

class QuestionController extends Controller
{
    use SafeResponse, Helper;

    private $language;
    private $course;
    private $part;
    private $question;

    public function __construct( 
            Part $part,
            Course $course,
            Question $question,
            Language $language
        ) {
        
            $this->part = $part;
            $this->course = $course;
            $this->language = $language;
            $this->question = $question;
            app()->setLocale('ka');
    }

    private function modelByType($type) {
        $model = false;

        switch($type) {
            case 'part':
                $model = $this->part->select('id')->listsTranslations('title');
                break;
            case 'course':
                $model = $this->course->select('id')->listsTranslations('short_desc');
                break;
        }

        return $model;
    }

    public function questionCreate(Request $request, $id, $type) {
        $languages = $this->language->get();        
        $model = $this->modelByType($type);

        if(!$model) {
            return back()->with('error','something wents wrong');
        }

        $item = $model->findOrFail($id);
        return view('web.backend.sections.teacherResources.questions.add', compact('item', 'type', 'languages'));
    }

    public function questionStore(QuestionRequest $request, $id, $type) {
        try{
            $answers = $request->answers;
            $data = $request->except('_token', 'answers');

            foreach($answers as $key => $answer) {
                $answers[$key]['isRight'] = in_array($key, $data['isRight']) ? true : false;
            }

            $model = $this->modelByType($type);

            if(!$model) {
                return back()->with('error','something wents wrong');
            }

            $question = $model->findOrFail($id)->questions()->create($data);
            $question->answers()->createMany($answers);
            
            return back()->with('success','კითხვა წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','კითხვის დამატება ვერ მოხერხდა');
        }
    }

    public function questionEdit(Request $request, $id) {
        $languages = $this->language->get();
        
        $question = $this->question
            ->with([
                'answers',
                'part' => function($q) {
                    return $q->select('id')->listsTranslations('title');
                },
                'course' => function($q) {
                    return $q->select('id')->listsTranslations('short_desc');
                }
            ])->findOrFail($id);

        $title = $question->part ? $question->part->title : $question->course->short_desc;

        $isRight = [];
        foreach( $question->answers as $key => $answer) {
            if($answer->isRight == true)
                $isRight[] = $key + 1;
            else 
                continue;
        }

        return view('web.backend.sections.teacherResources.questions.edit', compact('question', 'languages', 'isRight', 'title'));
    }

    public function questionUpdate(QuestionRequest $request, $id) {
        try{
            $answers = $request->answers;
            $data = $request->except('_token', 'answers');

            foreach($answers as $key => $answer) {
                $answers[$key]['isRight'] = in_array($key, $data['isRight']) ? true : false;
            }

            $question = $this->question->with('answers')->findOrFail($id);
            $question->update($data);

            foreach($question->answers as $key => $answer) {
                $answer->update($answers[$key + 1]);
            }
            
            return back()->with('success','კითხვა წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','კითხვის განახლება ვერ მოხერხდა');
        }
    }

    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "კითხვა წარმატებით გაქტიურდა" : "კითხვა წარმატებით დიაქტივირებულია",
            'error' => "კითხვის გააქტიურება ვერ მოხერხდა"
        ];
        return $this->safeResponse(function() use ($request, $id) {
            $this->question->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}
