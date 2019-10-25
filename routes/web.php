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
Route::get('/register',function (){
    return view('auth/register');
});
Route::get('/login',function(){
    return view('pages/login');
});

Route::any('/GoogleCallback','auth\LoginController@handleProviderCallback');

Route::get('/GoogleRedirect','auth\LoginController@RedirectGoogle');

Route::post('/register','auth\LoginController@register');


