<?php

namespace app\Traits;

use App\Models\User;

trait RoleTrait {

    const ROLE_MAP = [
    ];

    public function getRole(User $user) {
        $xp = $user->xp;

        if($xp == 0) {
            return "Newbie";
        }
    }
}