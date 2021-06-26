<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageAdditional;
use App\Models\Topic;

class ResourceController extends Controller
{
    private $resource;
    private $types = [
        'image',
        'link',
        'video',
        'pdf',
        'game',
        'exercise'
    ];
    private $sortable = [
        'date_asc' => ['column' => 'created_at', 'method' => 'ASC'],
        'date_desc' => ['column' => 'created_at', 'method' => 'DESC'],
        'char_asc' => ['column' => 'title', 'method' => 'ASC'],
        'char_desc' => ['column' => 'title', 'method' => 'DESC']
    ];

    public function __construct(PageAdditional $resource, Topic $topic)
    {
        $this->resource = $resource;
        $this->topic = $topic;
    }

    public function index(Request $request)
    {
        try {

            $raw = "";
            $search = '';
            $topic = '';
            $direction = '';
            $types = [];
            $sort = '';
            $query =  $this->resource->where('active', true)->where('pinned', true);

            if(isset($request->topic)) {
                $topic = $request->topic;
                $query->whereIn('topic_id', $topic);
            }

            if(isset($request->direction)) {
                $direction = $request->direction;
                $query->whereIn('direction', $direction);
            }

            foreach($this->types as $type) {
                if(isset($request->$type)) {
                    $types[] = $type;
                    if($type === 'game' || $type === 'exercise') {
                        $raw.= $raw === '' ? "sub_type = '".$type."'" : " or sub_type = '".$type."'";
                    }else {
                        $raw.= $raw === '' ? "type = '".$type."'" : " or type = '".$type."'";
                    }
                }
            }

            if($raw !== '')
                $query->whereRaw("(".$raw.")");
            

            if(isset($request->search)) {
                $search = $request->search;

                $query->whereTranslationLike('title', '%'.$search.'%')
                    ->orWhereTranslationLike('description', '%'.$search.'%')
                    ->orWhere('image', 'like', '%'.$search.'%')
                    ->orWhere('video', 'like', '%'.$search.'%')
                    ->orWhere('link', 'like', '%'.$search.'%')
                    ->orWhere('pdf', 'like', '%'.$search.'%');
            }
            
            if(isset($request->sort)) {
                $sort = $request->sort;

                if($sort === 'char_asc' || $sort === 'char_desc') {
                    $query->orderByTranslation($this->sortable[$sort]['column'], $this->sortable[$sort]['method']);
                }else {
                    $query->orderBy($this->sortable[$sort]['column'], $this->sortable[$sort]['method']);
                }
            }

            $resources = $query->paginate(32);
            $topics = $this->topic->select('id', 'active')->where('active', true)->get();

            return view('web.frontend.sections.additionalResource.resources', compact('resources', 'topics', 'search', 'types', 'topic', 'direction', 'sort'));

        } catch (\Throwable $e) {
            abort('404');
        }
    }
}