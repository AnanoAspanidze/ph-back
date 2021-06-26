<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        try {
            return view('web.frontend.sections.profile');
        }catch (\Throwable $e) {
            abort('404');
        }
    }
}
