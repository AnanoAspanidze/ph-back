<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\Explanation;
use App\Models\Topic;

class TopicController extends Controller
{
    private $topic;
    private $resource;
    private $explanation;
    
    public function __construct(Topic $topic, Resource $resource, Explanation $explanation)
    {
        $this->topic = $topic;
        $this->resource = $resource;
        $this->explanation = $explanation;
    }

    public function index(Request $request)
    {
        try {

            $search = '';
            $direction = 'student_resource';

            $query = $this->topic->where('active', true);

            $direction = isset($request->direction) ? $request->direction : (auth()->guest() ? 'student_resource' : 'teacher_resource');

            if($direction === 'student_resource') {
                $query->whereHas('resources');
            }else {
                $query->whereHas('course');
            }

            if(isset($request->search)) {
                $search = $request->search;

                $query->whereTranslationLike('title', '%'.$search.'%')
                    ->orWhereTranslationLike('tags', '%'.$search.'%');
            }
            
            $topics = $query->get();
            
            return view('web.frontend.sections.topic.index', compact('topics', 'search', 'direction'));

        }catch (\Throwable $e) {
            abort('404');
        }
    }

    public function inner($id, $page = null)
    {
        $topic = $this->topic->where('active', true)->with(['resources' => function($q) {
            $q->with('resourceable')->where('active', true)->orderBy('sort','ASC');
        }])->findOrFail($id);
        $topics = $this->topic->select('id', 'active')->where('active', true)->get();

        $query = $this->resource
            ->where('topic_id', $id)
            ->where('active', true)
            ->with([
                'resourceable',
                'parentStep.resourceable',
                'children' ,
                'explanations' => function($q) {
                    return $q->where('active', true);
                },
                'resources' => function($q) {
                    return $q->where('active', true);
                }
            ])
            ->orderBy('sort','ASC');

        $resource = $page ? $query->where('id', $page)->first() : $query->first();
                
        if(!$resource) {
            abort('404');
        }
        
        list($resources, $steps) = $this->orderResources($topic->resources);
        $topic->resources = $resources;
        
        $currentPageIndex = array_search($resource->id, array_keys($resources), true);
        $keys =  array_keys($resources);

        $previous = $keys[$currentPageIndex - 1] ?? null;
        $previous = $resources[$previous] ?? null;

        $next = $keys[$currentPageIndex + 1] ?? null;
        $next = $resources[$next] ?? null;

        return view('web.frontend.sections.topic.inner', compact('topic', 'topics', 'resource', 'previous', 'next', 'steps'));
    }

    private function array_insert(&$array, $position, $insert)
    {
        $key = array_search($position, array_keys($array), true);
        $array = array_slice($array, 0, $key + 1, true) +
        array($insert->id => $insert) +
        array_slice($array, $key + 1, count($array) - 1, true);
    }

    public function explanation($id)
    {
        $explanation = $this->explanation
            ->whereHas('resource', function($q) {
                return $q->where('active', true);
            })
            ->with(['resource' => function($q) {
                return $q->select('id', 'active', 'topic_id', 'resourceable_id', 'resourceable_type', 'parent')
                    ->with(['resources' => function($q) {
                        $q->where('active', true);
                    }, 'parentStep.resourceable']);
            }])
            ->where('active', true)
            ->findOrFail($id);
        $layout = $explanation->layout ?? 'default';
        $view = config('resourceable.Explanation.layouts.'.$layout);

        if(!$explanation->resource || !$explanation->resource->topic_id) {
            abort('404');
        }

        $topic = $this->topic->where('active', true)->with(['resources' => function($q) {
            $q->where('active', true)->with([
                'resourceable',
                'explanations' => function($q) {
                    return $q->where('active', true);
                }])
                ->orderBy('sort','ASC');
        }])->findOrFail($explanation->resource->topic_id);

        list($resources, $steps) = $this->orderResources($topic->resources);
        $topic->resources = $resources;

        $topics = $this->topic->select('id', 'active')->where('active', true)->get();
        return view('web.frontend.sections.topic.pages.explanation', compact('topic', 'topics', 'explanation', 'view'));
    }
    
    public function getPages(Request $request)
    {
        try {

            $resources = $this->resource
                ->select('id', 'active', 'topic_id', 'resourceable_id', 'resourceable_type', 'parent')
                ->with([
                    'resourceable',
                    'explanations'=> function($q) {
                        return $q->where('active', true);
                    },
                    'topics' => function($q) {
                        return $q->select('id');
                    }
                ])
                ->where('topic_id', $request->topic_id)
                ->where('active', true)
                ->orderBy('sort','asc')
                ->get();

            $resp = [];
            foreach($resources as $index => $resource) {
                if($resource->resourceable) {
                    $baseName = class_basename($resource->resourceable_type);
                    $resourceableItem = config('resourceable.'.$baseName);
                    $type = '';
                    $icon = '';
                    $title = '';
                    if($baseName === 'Other') {
                        $type = $resource->parent ? 'მსჯელობა' : 'კომპლექსური დავალება';
                        $icon = $resource->parent ? $resourceableItem['icon']['discussion'] : $resourceableItem['icon']['complex'];
                        $baseName = $resource->parent ? 'Discussion' : 'Complex';
                    }else {
                        $type = $resourceableItem['type'];
                        $icon = $resourceableItem['icon'] ?? "";
                    }
                    
                    
                    $title = $baseName === 'Intro' ? $resource->topics->title : $resource->resourceable->title;

                    $resp[] = [
                        'id' => $resource->id,
                        'baseName' => $baseName,
                        'route' => route('topics.inner', [$request->topic_id, $resource->id]),
                        'type' => $type,
                        'icon' => $icon,
                        'index' => $index + 1,
                        'active' => false,
                        'title' => $title
                    ];
                    
                    if($resource->explanations) {
                       foreach($resource->explanations as $expIndex => $explanation)  {
                           $explanationItem = config('resourceable.Explanation');

                            $resp[] = [
                                'id' => $explanation->id,
                                'baseName' => 'Explanation',
                                'route' => route('topics.explanation', $explanation->id),
                                'type' => 'განმარტება',
                                'icon' => $explanationItem['icon'],
                                'index' => ($index + 1).'-'.($expIndex + 1),
                                'active' => false,
                                'title' => $explanation->title
                            ];
                       }
                    }
                }
            }

            return response()->json(['pages' => $resp]);
        }catch (\Throwable $e) {
            abort(404);
        }
    }

    private function orderResources($resources) {
        $index = 1;
        $steps = [];
        $stepIndex = [];
        $response = [];
        foreach($resources as $item) {
            if($item->resourceable_type === 'App\Models\Step') {
                $item->index = $index++;
                $steps[] = $item;
                $stepIndex[$item->id] = $item->id;
            }

            if($item->parent) {
                
                if(!isset($stepIndex[$item->parent])) {
                    $stepIndex[$item->parent] = null;
                }

                $this->array_insert($response, $stepIndex[$item->parent], $item);
                $stepIndex[$item->parent] = $item->id;
            }else {
                $response[$item->id] = $item;
            }

        }
        return [$response, $steps];
    }
}
