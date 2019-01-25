<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Location extends Model
{
	use HasTags;

	/**
     * Get all of the location info
     */
    public function get_info()
    {
        return $this->morphMany('App\Information', 'get_information');
    }
}
