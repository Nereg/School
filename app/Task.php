<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
    * Get user to which it belongs
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
