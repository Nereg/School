<?php
use Illuminate\Http\Request;

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


Route::get('/login',function(){
    return view('pages/login');
});

Route::post('/login','auth\LoginController@Login');

//Activation route
Route::get('/activate/{id}/{code}','ActivationController@Activate');
/* 
* Social auth routes!
*/
Route::any('/GoogleCallback','auth\LoginController@handleProviderCallback');

Route::get('/GoogleRedirect','auth\LoginController@RedirectGoogle');


