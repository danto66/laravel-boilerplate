<?php

namespace App\Models\Pipes;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class SearchBy
{
    public function __construct(
        protected array $columns,
        protected string $keyword
    ) {}

    public function handle(Builder $query, Closure $next)
    {
        $query->where(function ($query) {
            foreach ($this->columns as $column) {
                $query->orWhere($column, 'like', "%{$this->keyword}%");
            }
        });

        return $next($query);
    }
}
