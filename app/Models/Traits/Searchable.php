<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearchBy(Builder $query, array $columns = [], string $search)
    {
        if (!$search || empty($columns)) {
            return $query;
        }

        $query->where(function ($query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$search}%");
            }
        });

        return $query;
    }
}
