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
        try
        {
            $user = Sentinel::authenticate($credentials,$tick);
            if ($user === false) // if failed 
            {
                return view('pages/login')->with('error','Похоже что-то пошло не так. Возможно ваш аккаунт еще не зарегистрирован.');
            }
            $user = Sentinel::Login($user,$tick);//yeah weird logic 
        }
        catch (NotActivatedException $e)
        {
            return view('pages/login')->with('error','Ваш аккаунт еще не активирован.');
        }
        catch (Exeption $e)
        {
            var_dump($e);
            return view('pages/login')->with('error','Похоже что-то пошло уж совсем не так. пожалуйста обратеитесь ко мне за дальнейшей помощью и прикрепите то что вы видите вверху.');
        }
        return \response('Похоже что вы залогинились!');
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
        $name = $user->getName();
        $email = $user->getEmail();
        $avatarUrl = $user->getAvatar();
        $Id =  $user->getId();
        $credentials = [
            'last_name' => $Id
        ];
        $LocalUser = Sentinel::findByCredentials($credentials);
        if ($LocalUser === false) // if failed 
        {
            var_dump($credentials);
            var_dump($Id);
            var_dump($LocalUser);
            //return \redirect('/register')->with(['good'=>'Теперь вам всего лишь осталось придумать пароль!','email'=>var_dump($LocalUser),'name'=>$name,'GId'=>$Id]);
        }
        var_dump($LocalUser);
        Sentinel::login($LocalUser,true);

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
