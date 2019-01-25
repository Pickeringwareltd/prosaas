<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Information extends Model
{
	use HasTags;
	
    /**
     * Get all of the owning commentable models.
     */
    public function get_information()
    {
        return $this->morphTo();
    }
}
