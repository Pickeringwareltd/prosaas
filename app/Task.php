<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * The processes that the task is included in
     */
    public function processes()
    {
        return $this->belongsToMany('App\Process')->withTimestamps();;
    }

}
