<?php

namespace App\Enums\Traits;

trait HasEnumUtils
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return array_reduce(self::cases(), function ($options, $case) {
            $options[$case->value] = method_exists($case, 'label') ? $case->label() : $case->name;
            return $options;
        }, []);
    }
}
