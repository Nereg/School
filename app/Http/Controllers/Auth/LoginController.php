<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;



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
        $email = $request->get('email');
        $pass = $request->get('password');
        $tick = $request->get('remember');
        $tick = isset($tick); //true if set ('on' is value) and false is isn`t set
        if (!\isEmptyOrNullString($email) or !\isEmptyOrNullString($pass)) //check if all needed stuff is empty or string with 0 chars if so fail the login
        {
            if($_ENV['APP_DEBUG'])var_dump($request->all());
            return \view('pages/login')->with('error','Не введено одно из полей. Этого не должно просиходить при обычной работе. Обратитесь к Создателю.');
        }
        else
        {
            $credentials = [ //make array with data for Sentinel
                'email' => $email,
                'password' => $pass
            ];
            $login = Sentinel::authenticate($credentials,$tick); //Auth user

            if($_ENV['APP_DEBUG'])var_dump($login);
            return \view('pages/login');
        }
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
