<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GamePageRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Resource;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Game;
use App\Models\Question;

class GamePageController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $game;
    private $language;
    private $resource;
    private $question;

    public function __construct( 
            Resource $resource,
            Topic $topic,
            Game $game,
            Question $question,
            Language $language
        ) {
        
            $this->topic = $topic;
            $this->game = $game;
            $this->resource = $resource;
            $this->language = $language;
            $this->question = $question;
            app()->setLocale('ka');
    }

    public function create(Request $request, $topic_id) {
        $languages = $this->language->get();

        $topic = $this->topic->select('id', 'illustration')->with(['resources' => function($query) {
            return $query->where('resourceable_type', 'App\Models\Step')->with('resourceable', 'children.resourceable');
        }])->findOrFail($topic_id);

        return view('web.backend.sections.studentResources.game.add', compact('topic', 'languages'));
    }

    public function store(GamePageRequest $request, $topic_id) {
        try{
            $data = $request->except('_token');

            $intro = $this->game->create($data);
            if(isset($data['resources']['parent'])) {
                $childrens = $this->resource->where('id', $data['resources']['parent'])
                    ->with(['children' => function($q) use ($data) {
                        return $q->where('sort', '>', $data['resources']['sort']); 
                }])->first()->children;
                foreach($childrens as $children) {
                    $children->update(['sort' => ($children->sort + 1 )]);
                }
            }

            $data['resources']['show_steps'] = $data['resources']['show_steps'] == 'on' ? true : false;
            $data['resources']['topic_id'] = $topic_id;
            $data['resources']['active'] = true;
            
            $intro->resource()->create($data['resources']);

            return redirect()->route('student_resources.resources', $topic_id)->with('success','სავარჯიშო წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','სავარჯიშოს დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $game = $this->game->with(['resource.explanations', 'questions' => function($q) {
            return $q->withCount('answers');
        }])->findOrFail($id);
        return view('web.backend.sections.studentResources.game.edit', compact('game', 'languages'));
    }

    public function update(GamePageRequest $request, $id) {
        try{
            
            $data = $request->except('_token');
            $other = $this->game->with('resource')->findOrFail($id);

            $data['resources']['show_steps'] = $data['resources']['show_steps'] == 'on' ? true : false;
            $other->resource->update($data['resources']);
            $other->update($data);

            return redirect()->route('student_resources.resources', $other->resource->topic_id)->with('success','სავარჯიშო წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','სავარჯიშოს განახლება ვერ მოხერხდა');
        }
    }

    public function questionCreate(Request $request, $game_id) {
        $languages = $this->language->get();
        $game = $this->game->select('id')->listsTranslations('title')->findOrFail($game_id);
        return view('web.backend.sections.studentResources.game.questions.add', compact('game', 'languages'));
    }

    public function questionStore(QuestionRequest $request, $game_id) {
        try{
            $answers = $request->answers;
            $data = $request->except('_token', 'answers');

            foreach($answers as $key => $answer) {
                $answers[$key]['isRight'] = in_array($key, $data['isRight']) ? true : false;
            }

            $data['game_id'] = $game_id;
            $question = $this->question->create($data);
            $question->answers()->createMany($answers);
            
            return back()->with('success','კითხვა წარმატებით მიება ფორმას');
        } catch (\Throwable $e) {
            return back()->with('error','კითხვის დამატება ვერ მოხერხდა');
        }
    }

    public function questionEdit(Request $request, $id) {
        $languages = $this->language->get();
        
        $question = $this->question->with(['answers', 'game' => function($q) {
            return $q->select('id')->listsTranslations('title');
        }])->findOrFail($id);

        $isRight = [];
        foreach( $question->answers as $key => $answer) {
            if($answer->isRight == true)
                $isRight[] = $key + 1;
            else 
                continue;
        }

        return view('web.backend.sections.studentResources.game.questions.edit', compact('question', 'languages', 'isRight'));
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
