<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    /*
	 * The tasks that belong to the process.
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

}
