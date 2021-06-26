<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Language;

class TopicController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $language;

    public function __construct( Topic $topic, Language $language ) {
        $this->topic = $topic;
        $this->language = $language;
        app()->setLocale('ka');
    }

    public function index(Request $request) {
        $topics = $this->topic->select('id', 'illustration', 'active')->get();
        return view('web.backend.sections.topics.index', compact('topics'));
    }

    public function create(Request $request) {
        $languages = $this->language->get();
        return view('web.backend.sections.topics.add', compact('languages'));
    }

    public function store(TopicRequest $request) {
        try{
            $data = $request->except('_token');
            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $data['illustration'] = \FileUpload::run($request->illustration, 'topic');
            }
            
            $this->topic->create($data);
            return redirect()->route('topic.index')->with('success','თემა წარმატებით დაემატა');
        } catch (\Throwable $e) {
            return back()->with('error','თემა დამატება ვერ მოხერხდა');
        }
    }

    public function edit(Request $request, $id) {
        $languages = $this->language->get();
        $topic = $this->topic->select('id', 'illustration', 'active')->findOrFail($id);
        return view('web.backend.sections.topics.edit', compact('topic', 'languages'));
    }

    public function update(TopicRequest $request, $id) {
        try{

            $data = $request->except('_token');
            $topic = $this->topic->findOrFail($id);

            if( isset($data['illustration']) && file_exists($data['illustration'])){
                $this->deleteFile('storage/topic/', $topic->illustration);
                $data['illustration'] = \FileUpload::run($request->illustration, 'topic');
            }

            $topic->update($data);

            return redirect()->route('topic.index')->with('success','თემა წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','თემის განახლება ვერ მოხერხდა');   
        }
    }

    public function activate(Request $request, $id) {
        $messages = [
            'success' => $request->status ? "თემა წარმატებით გაქტიურდა" : "თემა წარმატებით დიაქტივირებულია",
            'error' => "თემა გააქტიურება ვერ მოხერხდა"
        ];
        return $this->safeResponse(function() use ($request, $id) {
            $this->topic->findOrFail($id)->update(['active' => $request->status]);
            return [ "type" => 200, "errors" => []];
        }, $messages);
    }
}