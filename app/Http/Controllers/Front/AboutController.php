<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    private $about;

    public function __construct(About $about)
    {
        $this->about = $about;
    }

    public function index($page = null)
    {
        $abouts = $this->about->where('active', true)->where('pinned', false)->with(['aboutImgs' => function($q) {
            return $q->where('active', true);
        }])->get();
        return view('web.frontend.sections.about.index', compact('abouts', 'page'));
    }
}
