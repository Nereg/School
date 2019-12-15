<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use  App\Http\Middleware\loginCheck;
use Socialite;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

class TaskController extends Controller
{
    public function __construct()
    {
      $this->middleware('checkAuth');
    }
    public function test()
    {
        return 'Test';
    }
}
