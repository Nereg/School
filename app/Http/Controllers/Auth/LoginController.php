<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirect = '/';

    /**
     * Register user
     * @param string user`s email 
     * @param string Password of user
     * @return void
     */
    public function register(Request $request)
    {
        $user = Sentinel::findByCredentials(['email'=>$request->input('email')]);
        //var_export($request->all());
        //return "Hello from controller !";
        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'name'     => $request->input('name'),
        ];
        
        //$user = Sentinel::register($credentials);
        if (!$user->exist)
        {
            return 'User exsist';
        }
        var_dump($user);
        return 'hello!';

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
