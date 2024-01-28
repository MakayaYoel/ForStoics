<?php

namespace App\Orchid\Layouts;

use App\Orchid\Filters\UserNameFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class UserNameFilterLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            UserNameFilter::class,
        ];
    }
}
