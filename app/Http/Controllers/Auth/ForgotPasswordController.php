<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Validator;
use Socialite;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Restore password 
     */
    public function RestorePassword (Request $request)
    {
        //\dd($request->all());
        $messages = [ // Some errors messages in Russian :\
            'password.required' => 'Вы не ввели пароль !',
            'password.min' => 'Для вашей безопасности пароль должен быть минимум 6 символов!',
            'required' => 'Вы что-то не ввели!',
        ];
        $rules = [ //rules for vallidation
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return view('pages/forgot')
                        ->withErrors($validator);
        }
        $user = Sentinel::findById(\intval($request->get('id')));
        //var_dump($user);
        $Reminder = Reminder::exists($user);
        //var_dump($Reminder);
        if (is_bool($Reminder))
        {
            return view('pages/restore')->with('error','Нет запроса смены пароля на этот аккаунт!');
        }
        else
        {
            $result = Reminder::complete($user, $request->get('code'), $request->get('password'));
            if ($result)
            {
                return \redirect('/login')->with('good','Теперь вы можете войти!');
            }
            else
            {  
                return view('pages/restore')->with('error','Нет запроса смены пароля на этот аккаунт!');
            }
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
