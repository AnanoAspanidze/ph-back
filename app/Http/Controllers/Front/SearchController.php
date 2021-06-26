<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\About;
use App\Models\PageAdditional;

class SearchController extends Controller
{
    private $topic;
    private $about;
    private $resource;
    
    public function __construct(Topic $topic, PageAdditional $resource, About $about)
    {
        $this->topic = $topic;
        $this->about = $about;
        $this->resource = $resource;
    }

    public function index(Request $request)
    {
        // try {
            
            $results = 0;
            $topics = [];
            $abouts = [];
            $resources = [];
            $search ='';
            
            if($request->search) {
                $search = $request->search;

                $topics = $this->topic->where('active', true)
                    ->select('id', 'illustration', 'active')
                    ->whereTranslationLike('title', '%'.$search.'%')
                    ->orWhereTranslationLike('tags', '%'.$search.'%')
                    ->get();

                $resources = $this->resource->where('active', true)
                    ->select('id', 'image', 'active', 'video', 'type', 'pdf', 'link')
                    ->whereTranslationLike('title', '%'.$search.'%')
                    ->orWhereTranslationLike('description', '%'.$search.'%')
                    ->get();

                $abouts = $this->about->where('active', true)
                    ->where('pinned', 0)
                    ->select('id', 'active')
                    ->whereTranslationLike('title', '%'.$search.'%')
                    ->orWhereTranslationLike('text', '%'.$search.'%')
                    ->get();
                $results = count($topics) + count($resources) + count($abouts);
            }

            return view('web.frontend.sections.search.index', compact('results', 'search', 'resources', 'topics', 'abouts'));

        // }catch (\Throwable $e) {
        //     abort('404');
        // }
    }
}
