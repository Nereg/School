<?php
namespace App;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
      /**
   * Получить все задачи пользователя.
   */
  public function tasks()
  {
    return $this->hasMany(Task::class,'userId');
  }
}