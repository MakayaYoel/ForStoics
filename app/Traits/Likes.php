<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likes {

    // Define a one to many polymorphic relationship
    public function likes() : MorphMany {
        return $this->morphMany(Like::class, 'likeable');
    }

}