<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


use Validator;
use Socialite;

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

    /*
    * login user from form
    * @param mixed Request 
    * @return mixed Response
    */

    public function Login (Request $request)
    {
        $messages = [ // Some errors messages in Russian :\
            'email.required' => 'Нам надо знать ваш e-mail!',
            'email.email' => 'Вы ввели неправильную електронную почту!',
            'password.min' => 'Для вашей безопасности пароль должен быть минимум 6 символов!',
            'required' => 'Вы что-то не ввели!',
        ];
        $rules = [ //rules for vallidation
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|',
        ];
        $tick = $request->get('remember');
        $tick = isset($tick);
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return view('pages/login')
                        ->withErrors($validator);
        }
        $credentials =[
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
        ];
        $user = Sentinel::authenticate($credentials,$tick);
        var_dump($user);
        return 'test';
    }


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
            'first_name'     => $request->input('name'),
        ];
        
        //$user = Sentinel::register($credentials);
        if (!$user->exist)
        {
            return 'User exsist';
        }
        var_dump($user);
        return 'hello!';

    }

    /*
    * Redirect user to google auth page
    * @return Response
    */
    public function RedirectGoogle ()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        \var_dump($user);
        return 'DONE!';
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
