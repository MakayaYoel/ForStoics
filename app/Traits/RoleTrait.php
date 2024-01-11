<?php

namespace app\Traits;

use App\Models\User;

trait RoleTrait {

    const ROLES = [
        "Newbie" => [
            'min-xp' => 0,
            'tw-color' => "neutral-500"
        ],
        "Disciple" => [
            'min-xp' => 1000,
            'tw-color' => "amber-500"
        ],
        "Adept" => [
            'min-xp' => 3000,
            'tw-color' => "lime-500"
        ],
        "Sage" => [
            'min-xp' => 5000,
            'tw-color' => "teal-500"
        ],
        "Stoic Master" => [
            'min-xp' => 10000,
            'tw-color' => "purple-500"
        ],
    ];
}