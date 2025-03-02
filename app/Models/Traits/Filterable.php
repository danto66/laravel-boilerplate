<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilterBy(Builder $query, string $column, string $value)
    {
        if (!$value || !$column) {
            return $query;
        }

        $query->where($column, $value);

        return $query;
    }

    public function scopeFilterByArray(Builder $query, array $filters)
    {
        if (empty($filters)) {
            return $query;
        }

        foreach ($filters as $column => $value) {
            if (!$value || !$column) {
                continue;
            }

            if (is_array($value)) {
                $query->whereIn($column, $value);
            } else {
                $query->where($column, $value);
            }
        }

        return $query;
    }
}
