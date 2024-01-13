<?php

namespace App\Models;

use App\Traits\RankTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{

    use RankTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    // Returns a collection of all the users' posts (if accessed through its class proprety)
    public function posts() : HasMany {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    // Returns the rank data of the player's rank
    public function getRankData() : array {
        $data = [];

        foreach(array_reverse(self::RANKS) as $rank_name => $rank_data) {
            if($this->xp >= $rank_data['min-xp']){
                $data['rank_name'] = $rank_name;
                $data['rank_color'] = $rank_data['color'];

                break;
            }
        }

        return $data;
    }
}
