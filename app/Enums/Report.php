<?php

namespace App\Constants;

enum Report:int {

    // Report Types
    const SPAM = 0;
    const INAPPROPRIATE = 1;
    const BULLYING = 2;

    public function title() : string {
        return match($this) {
            Report::SPAM => "Spam",
            Report::INAPPROPRIATE => "Inappropriate Content",
            Report::BULLYING => "Bullying or Harassment"
        };
    }
}