<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Validator;
use Socialite;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use App\Jobs\SendPasswordEmail;

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
    *  Create password reset email
    * @param mixed $requist
    * @return mixed Result
    */
    public function ResetPassword (Request $request)
    {
        $messages = [ // Some errors messages in Russian :\
            'email.required' => 'Нам надо знать ваш e-mail!',
            'email.email' => 'Вы ввели неправильную електронную почту!',
            'required' => 'Вы что-то не ввели!',
        ];
        $rules = [ //rules for vallidation
            'email' => 'required|email|max:255',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return view('pages/forgot')
                        ->withErrors($validator);
        }
        $credentials =[
            'email'=>$request->get('email'),
        ];
        $user = Sentinel::findByCredentials($credentials);
        //var_dump($user);
        if (is_null($user))
        {
            return view('pages/forgot')->with('error','Нет аккаунта с такой почтой!');
        }
        else
        {
            $reminder = Reminder::create($user);
            dispatch(new SendPasswordEmail($user->id));
        return \view('pages/login')->with('good','Проверте вашу почту на наличее письма !');

        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
