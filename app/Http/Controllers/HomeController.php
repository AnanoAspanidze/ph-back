<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\About;

class HomeController extends Controller
{
    private $topic;
    private $about;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, About $about)
    {
        $this->topic = $topic;
        $this->about = $about;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topics = $this->topic->where('active', true)->get();
        $about = $this->about->where('active', true)->where('pinned', true)->first();
        return view('web.frontend.sections.home', compact('topics', 'about'));
    }

    public function upload(Request $request)
    {
        $test = \FileUpload::run($request->photo, 'test');
        return view('home');
    }
}
