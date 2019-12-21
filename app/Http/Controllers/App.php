<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class App extends Controller
{
  public function __construct()
  {
    $this->middleware('checkAuth');
  }

  public function MainPage()
  {
    $user = Sentinel::check();
    $task = $user->tasks()->get();
    var_dump($task);
    var_dump($user);
  }
}
