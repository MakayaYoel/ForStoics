<?php

namespace App\Enums;

enum Report:int {

    // Report Types
    case SPAM = 0;
    case INAPPROPRIATE = 1;
    case BULLYING = 2;

    // Returns a report types' title.
    public function title() : string {
        return match($this) {
            Report::SPAM => "Spam",
            Report::INAPPROPRIATE => "Inappropriate Content",
            Report::BULLYING => "Bullying or Harassment"
        };
    }
}