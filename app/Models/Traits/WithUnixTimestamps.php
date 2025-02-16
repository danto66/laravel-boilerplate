<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait WithUnixTimestamps
{
    protected function createdAtUnix(): Attribute
    {
        return Attribute::make(
            get: fn($_, $attributes) => Carbon::parse($attributes['created_at'])->unix(),
            set: fn($_, $attributes) => Carbon::createFromTimestamp($attributes['created_at']),
        );
    }

    protected function updatedAtUnix(): Attribute
    {
        return Attribute::make(
            get: fn($_, $attributes) => Carbon::parse($attributes['updated_at'])->unix(),
            set: fn($_, $attributes) => Carbon::createFromTimestamp($attributes['updated_at']),
        );
    }
}
