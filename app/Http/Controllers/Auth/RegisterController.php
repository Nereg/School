<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Queue;
use App\Jobs\SendReminderEmail;
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
    * Register user 
    * @param mixed Request
    */
    public function Register(Request $request)
    {
        $messages = [ // Some errors messages in Russian :\
            'email.required' => 'Нам надо знать ваш e-mail!',
            'email.email' => 'Вы ввели неправильную електронную почту!',
            'email.unique' => 'Кто-то уже зарегистрирован под такой електронной почтой!',
            'passwordConfirm.same' => 'Подтверждение пароля и пароль не совпадают!',
            'password.min' => 'Для вашей безопасности пароль должен быть минимум 6 символов!',
            'required' => 'Вы что-то не ввели!',
        ];
        $rules = [ //rules for vallidation
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|',
            'passwordConfirm' => 'same:password'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return view('pages/register')
                        ->withErrors($validator);
          }
        $credentials =[
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'first_name'=>$request->get('name'),
            'last_name' => $request->get('GId'), //yeah I'm to lazy to make new migration
        ];
        if ($request->has('Gid')) {
            $isGoogle = true;
        }
        else
        {
            $isGoogle = false;
        }

        $user = Sentinel::register($credentials,$isGoogle);
        $user = json_decode($user);
        Queue::push(new SendReminderEmail($user->$id));
        return \redirect('/')->with('good','Теперь вы можете войти в систему.');
    }
}
