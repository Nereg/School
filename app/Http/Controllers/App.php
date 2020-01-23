<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Validator;
use App\Task;
use \Carbon\Carbon;

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
    return \view('panel/test', ['tasks' => $task]);
    /*
    foreach ($task as $key => $value) {
        var_dump($key);
        var_dump($value);
    }
    */
  }

  public function createTask(Request $Request)
  {
    $messages = [ // Some errors messages in Russian :\
        'required' => 'Вы что-то не ввели!',
    ];
    $rules = [ //rules for vallidation
        'name' => 'required',
        'description' => 'required',
    ];
    $validator = Validator::make($Request->all(),$rules,$messages);
    $user = Sentinel::check();
    $task = new Task;
    $task->name = $Request->get('name');
    $task->description = $Request->get('description');
    $task->userId = $user->id;
    $task->start = Carbon::now();
    $task->save();
  }

  public function deleteTask(Request $Request)
  {
    $messages = [ // Some errors messages in Russian :\
      'required' => 'Вы что-то не ввели!',
    ];
    $rules = [ //rules for vallidation
       'id' => 'required',
    ];
    $validator = Validator::make($Request->all(),$rules,$messages);
    $user = Sentinel::check();
    $task = Task::where('Id',$Request->get('id'))->where('userId',$user->id)->delete();
  }

  public function updateTask(Request $Request)
  {
    $messages = [ // Some errors messages in Russian :\
      'required' => 'Вы что-то не ввели!',
    ];
    $rules = [ //rules for vallidation
       'id' => 'required',
       'name' => 'required',
       'description' => 'required',
    ];
    $validator = Validator::make($Request->all(),$rules,$messages);
    $user = Sentinel::check();
    $task = Task::where('Id',$Request->get('id'))->where('userId',$user->id)->get();
    $task->name = $Request->get('name');
    $task->description = $Request->get('description');
    $task->save();
  }
}
