<?php

namespace app\Traits;

use App\Models\User;

trait RankTrait {

    const RANKS = [
        "Newbie" => [
            'min-xp' => 0,
            'color' => "#737373"
        ],
        "Disciple" => [
            'min-xp' => 500,
            'color' => "#F59E0B"
        ],
        "Adept" => [
            'min-xp' => 1000,
            'color' => "#84CC16"
        ],
        "Sage" => [
            'min-xp' => 2000,
            'color' => "#14B8A6"
        ],
        "Stoic Master" => [
            'min-xp' => 3000,
            'color' => "#A855F7"
        ],
    ];
}