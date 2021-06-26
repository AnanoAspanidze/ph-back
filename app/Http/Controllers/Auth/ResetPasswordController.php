<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ResetEmailRequest;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordResetRequest;
use App\User;
use App\Mail\ResetEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function resetEmail(ResetEmailRequest $request) {

        if($user = User::where('email', $request->email)->first()) {
            
            $token =  Hash::make(time()); 
            $user->verification_code = $token;
            $user->save();
            
            Mail::to($user->email)->send(new ResetEmail($token));
            return view('auth.passwords.confirm');
        }
        
        abort('404');
    }

    public function passwordreset(Request $request) {
        if(isset($request->token) && $user = User::where('verification_code', $request->token)->first()) {
            return view('auth.passwords.reset', ['token' => $request->token, 'user' => $user]);
        }

        abort('404');
    }

    public function reseting(PasswordResetRequest $request) {

        if(isset($request->token) && isset($request->email) && $user = User::where('verification_code', $request->token)->where('email', $request->email)->first()) {
            $user->password = Hash::make($request->password);
            $user->verification_code = null;
            $user->save();
            return view('auth.passwords.confirmed');
        }

        abort('404');       
    }
}
