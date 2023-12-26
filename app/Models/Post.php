<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    // Gets the user that the post belongs to.
    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
