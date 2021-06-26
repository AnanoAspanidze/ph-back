<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Models\Region;
use App\Models\Position;
use App\Mail\SignupEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $regions = Region::get();
        $positions = Position::get();
        
        return view('auth.register', compact('regions', 'positions'));
    }

    public function register (RegisterRequest $request) {    
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['verification_code'] = Hash::make(time());        
        
        $user = User::create($data);
        
        if($user) {
            Mail::to($user->email)->send(new SignupEmail($user, $user->verification_code));
            // show a message
            return view('auth.verify');
        }

        abort('404');
    }

    public function verifyUser(Request $request ) {
        if (!$request->verify_token) {
            abort('404');
        }

        $user = User::where('verification_code', $request->verify_token)->first();

        if($user) {
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->verification_code = null;
            $user->save();
            return view('auth.verified');
        }

        abort('404');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

        // writed by me 
    // public function resetPasswordConfirm(Request $request)
    // {
        // $arr = [
        //     'result' => 'fail',
        //     'msg' => 'Error',
        //     'error' => 'Wrong URL or data!',
        // ];

        // $user = User::where('id', Auth::id())->where('change_password_token', $request->change_password_token)->first();

        // if ($user && $request->password_token != '' && $user->updated_at->diffInMinutes(Carbon::now()) < 5) {
        //     $user->password = Crypt::decryptString($request->password_token);
        //     $user->change_password_token = null;
        //     $user->save();

        //     $arr = [
        //         'result' => 'success',
        //         'msg' => 'Password has been updated successfully',
        //         'error' => '',
        //     ];
        // }

        // return response()->json($arr);
    // }
}
