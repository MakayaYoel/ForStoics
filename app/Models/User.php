<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Models\Like as LikeModel;
use App\Traits\RankTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Mchev\Banhammer\Traits\Bannable;
use Orchid\Screen\AsSource;
use Orchid\Support\Facades\Dashboard;

class User extends Authenticatable
{

    use RankTrait, AsSource, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'permissions'
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

    // Define a one to many relationship between Users and Posts.
    public function posts() : HasMany {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    // Define a one to many relationship between Users and Likes.
    public function likes() : HasMany {
        return $this->hasMany(LikeModel::class, 'user_id', 'id');
    }

    // User likes a model
    public function like(Likeable $likeable) : bool {
        if($this->hasLiked($likeable)) return false;

        (new LikeModel())
            ->user()->associate($this) // Set the user id
            ->likeable()->associate($likeable) // Set the model id
            ->save(); // save

        return true;
    }

    // User unlikes a model
    public function unlike(Likeable $likeable) : bool {
        if(!$this->hasLiked($likeable)) return false;

        $likeable->likes()
            ->whereHas('user', fn($query) => $query->whereId($this->id)) // Find whether the user liked the likeable
            ->delete(); // Delete the record/unlike the likeable

        return true;
    }

    // Checks whether the user has liked a model
    public function hasLiked(Likeable $likeable) : bool {
        // Check if the model actually exists.
        if(!$likeable->exists) return false;

        return $likeable->likes()
            ->whereHas('user', fn($query) => $query->whereId($this->id))
            ->exists();
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

    // Get the user's next rank data
    public function getNextRankData() : ?array {
        $currentRank = $this->getRankData()['rank_name'];

        $array = array_keys(self::RANKS);

        $index = array_search($currentRank, $array) + 1;

        $nextRank = $array[$index] ?? 0;

        $result = isset(self::RANKS[$nextRank]) ? array_merge(["index" => $index], self::RANKS[$nextRank]) : null;

        return $result;
    }

    public static function createAdmin(string $name, string $email, string $password): void{
        throw_if(static::where('email', $email)->exists(), 'User already exists');

        static::create([
            'name'        => $name,
            'email'       => $email,
            'password'    => Hash::make($password),
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);
    }
}
