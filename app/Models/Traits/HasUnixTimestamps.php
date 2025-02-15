<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasUnixTimestamps
{
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->unix(),
            set: fn($value) => Carbon::createFromTimestamp($value),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->unix(),
            set: fn($value) => Carbon::createFromTimestamp($value),
        );
    }
}
