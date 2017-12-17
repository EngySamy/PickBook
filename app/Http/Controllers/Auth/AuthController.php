<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Auth;
use Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function authenticated( $user)
    {
        $credentials = Input::only('email', 'password'); 

        if ( ! Auth::attempt($credentials))
        {
            return Redirect::back()->withMessage('Invalid credentials');
        }

        if (Auth::user()->role == 1 || Auth::user()->role == 4)
        {
            return Redirect::to('/');
        }

        if (Auth::user()->role == 2) 
        {
            return Redirect::to('/AdminHome');
        }
            
        if (Auth::user()->role == 3) 
        {
            return Redirect::to('/HRPanel');
        }


    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'First_Name' => 'required|max:20|alpha',
            'Last_Name' => 'required|max:20|alpha',
            'Email' => 'required|email|max:255|unique:users|confirmed',
            'Password' => 'required|min:6|confirmed',
            'Address'=>'required|regex:/^[a-zA-Z0-9\s,]+$/',
            'Phone'=>'required|unique:users|numeric',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['First_Name'].' '.$data['Last_Name'],
            'email' => $data['Email'],
            'password' => bcrypt($data['Password']),
            'address'=>trim($data['Address']),
            'phone'=>$data['Phone'],
        ]);

        $insertedID = $user->id;
        $user->username = strtolower($data['First_Name'][0]).strtolower($data['Last_Name'][0]).($insertedID*11).rand(100,999);
        
        $user->role=1;
        $user->save();
        return $user;
    }
}
