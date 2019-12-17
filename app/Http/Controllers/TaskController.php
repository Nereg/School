<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use  App\Http\Middleware\loginCheck;
use Socialite;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\DB;
use App\Task;
use \Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
      $this->middleware('checkAuth');
    }
    private function saveTask($name,$descript='')
    {
      $user = Sentinel::check();
      $id = $user['original']['id'];
      $start = Carbon::now();//not implimented in this version
      $task = new Task;
      $task->name= $name;
      $task->description = $descript;
      $task->start = $start;
      $task->userId = $id;
      $task->save();
    }
    public function test()
    {
      $user = Sentinel::check();
      $id = $user['original']['id'];
      $task = new Task;
      //$tasks = DB::table('users')->insertGetId(
      //  ['start' => date_create(), 'name' =>'test', 'description' => 'test task','userId'=>1]
      //);
      $this->saveTask('Test Task','First task with funxtion');
      var_dump($task::all());
      return 'your username is :'. $user['original']['id'];
    }
}
