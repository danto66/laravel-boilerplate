<?php

namespace App\Enums\User;

use App\Enums\Traits\HasEnumUtils;

enum UserGender: string
{
    use HasEnumUtils;

    case Male = 'male';
    case Female = 'female';

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female'
        };
    }
}
