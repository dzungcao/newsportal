<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\ActivationService;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $loginPath = '/login';
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
    protected $redirectTo = '/news';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout','setPassword','activateUser']]);
        $this->activationService = $activationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
        
        return $validator;
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt(str_random(32)),
        ]);
        $this->activationService->sendActivationMail($user);
        \Session::flash('message','Please check your email to complete registration, otherwise you could not publish your news reports.');
        return $user;
    }

    /*
    * Set this account to active with summitted password
    */
    public function activateUser($token)
    {
        $rules = ['password'=>'required|min:6|confirmed'];
        $validator = \Validator::make(\Input::all(),$rules);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        if ($user = $this->activationService->activateUser($token,\Input::get('password'))) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    /*
    * Display a form for user to put password of their choice
    */
    public function setPassword($token)
    {
        $user = $this->activationService->getUser($token);
        if(!$user) abort(404);
        return view('auth.password',compact('token','user'));
    }
}
