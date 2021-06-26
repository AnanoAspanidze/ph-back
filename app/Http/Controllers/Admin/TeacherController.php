<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class TeacherController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
        app()->setLocale('ka');
    }
    
    public function index(Request $request) {
        $users = $this->user
            ->doesntHave('roles')
            ->select('id', 'position_id', 'region_id', 'name', 'surname', 'position_name', 'email', 'work_place', 'email_verified_at')
            ->with('position', 'region')
            ->get();

        return view('web.backend.sections.teachers.index', compact('users'));
    }
}
