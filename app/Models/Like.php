<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    // Get the user who liked.
    public function user() : BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Get who 'owns' the like, Post
    public function likeable() : MorphTo{
        return $this->morphTo();
    }
}
