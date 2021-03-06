<?php
use Illuminate\Http\Request;
use App\Mail\PasswordEmail;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*Just a main page
*/
Route::get('/', function () {
    return view('pages/MainPage');
});

/*
* AUTH routes!
*/

//Register route
Route::get('/register',function (){
    return view('pages/register');
});

// For POST from form
Route::post('/register','auth\RegisterController@Register');
// Login route
Route::get('/login',function(){
    return view('pages/login');
});

// Login route for POST
Route::post('/login','auth\LoginController@Login');
//checher of logining
Route::get('/check',function (){
    return redirect('/app');
});

//Activation route
Route::get('/activate/{id}/{code}','ActivationController@Activate');
//Forgot password route
Route::get('/forgot',function(){
    return view('pages/forgot');
});

//POST for form
Route::post('/forgot','auth\ResetPasswordController@ResetPassword');
//restore password route 
Route::get('/restore/{id}/{code}',function ($id,$code) {
    return view('pages/restore')->with(['id'=>$id,'code'=>$code]);
});
Route::post('/restore','auth\ForgotPasswordController@RestorePassword');
/* 
* Social auth routes!
*/
Route::any('/GoogleCallback','auth\LoginController@handleProviderCallback');

Route::get('/GoogleRedirect','auth\LoginController@RedirectGoogle');
/*
* App routes
*/
Route::get('/app','App@MainPage');

Route::post('/createTask','App@createTask');

Route::post('/deleteTask','App@deleteTask');

Route::post('/updateTask','App@updateTask');

Route::get('/form',function () {
    return view('panel/form');
});


