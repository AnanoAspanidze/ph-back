<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct( User $user ) {
        $this->user = $user;
    }

    public function edit(Request $request, $id) {
        $user = $this->user->select('id', 'position_id', 'region_id', 'name', 'surname', 'position_name', 'work_place', 'email')->with('position', 'region')->findOrFail($id);
        return view('web.backend.sections.profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request, $id) {
        try{
            $data = $request->except('_token');

            if(isset($data['password']) && $data['password'] !== '') {
                $data['password'] = bcrypt($data['password']);
            }else {
                unset($data['password']);
            }

            $this->user->findOrFail($id)->update($data);

            return back()->with('success','პროფილი წარმატებით განახლდა');
        } catch (\Throwable $e) {
            return back()->with('error','პროფილის განახლება ვერ მოხერხდა');   
        }       
    }
}
