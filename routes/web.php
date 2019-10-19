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
Route::get('/register',function (){
    return view('auth/register');
});
Route::post('/register','auth\LoginController@register');

Auth::routes();

Route::get('/home', 'HomeController@index');
