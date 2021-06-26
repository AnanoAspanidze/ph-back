<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\TopicRequest;
use App\Http\Traits\SafeResponse;
use App\Http\Traits\Helper;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Resource;

class StudentResourcesController extends Controller
{
    use SafeResponse, Helper;

    private $topic;
    private $language;
    private $resource;

    public function __construct( Topic $topic, Language $language, Resource $resource ) {
        $this->topic = $topic;
        $this->language = $language;
        $this->resource = $resource;
        app()->setLocale('ka');
    }

    public function index(Request $request) {
        $topics = $this->topic->select('id', 'illustration')->get();
        return view('web.backend.sections.studentResources.index', compact('topics'));
    }

    public function resources($id) {
        $topic = $this->topic->select('id', 'illustration')
                ->with([
                    'resources' => function($query) {
                        return $query->where('parent', 0)->orderBy('sort','ASC')->with('children.resourceable', 'resourceable');
                    }
                ])
                ->findOrFail($id);
        return view('web.backend.sections.studentResources.resource', compact('topic'));        
    }

    public function sortResources(Request $request) {
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