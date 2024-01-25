<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Post extends Model implements Likeable{
    use HasFactory, Likes;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'cover_image'
    ];

    // Gets the user that the post belongs to.
    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Gets all the post's comments.
    public function comments() : HasMany{
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
