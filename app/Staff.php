<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Staff extends Model
{
	use HasTags;

	/**
     * Get all of the staff info
     */
    public function get_info()
    {
        return $this->morphMany('App\Information', 'get_information');
    }
}
