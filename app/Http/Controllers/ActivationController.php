<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

use Validator;
use Socialite;

class ActivationController extends Controller
{
    public function Activate (Request $request,$id,$code)
    {
        $user = Sentinel::findById($id);
        $activation = Activation::exists($user);
        if (!$activation) //false for no activation
        {
            return response('Скорее всего ваш аккаунт уже активирован. 
            <a href="'. url('/login').'">Войти</a>')->header('Content-Type', 'text/html');
        }
        else
        {
            if (Activation::complete($user, $code))
            {
                return \redirect('/')->with('good', 'Активация прошла успешно ! Теперь вы можете пользоваться своим аккаунтом!');
            }
            else
            {  
                var_dump($validation);
                return response('Похоже что-то пошло не так. Попробуйте пройти активацию еще раз. Также пожалуйста сообщите информацию которую вы видите вверху мне.')->header('Content-Type', 'text/html');
            }
        }
        $user = Sentinel::findById($id);
        var_dump($user);
        echo 'The code is:'. $user->email;
    }
}
