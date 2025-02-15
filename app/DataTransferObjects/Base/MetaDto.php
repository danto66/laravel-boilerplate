<?php

namespace App\DataTransferObjects\Base;

use App\DataTransferObjects\Contracts\ToArray;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class MetaDto implements ToArray
{
    public function __construct(
        public int $total,
        public int $firstItem,
        public int $perPage,
        public int $currentPage,
        public int $lastPage,
    ) {}

    public static function whenEmpty(): self
    {
        return new self(
            total: 0,
            firstItem: 0,
            perPage: 0,
            currentPage: 0,
            lastPage: 0,
        );
    }

    public static function fromPaginator(?LengthAwarePaginator $paginator): self
    {
        if (empty($paginator) || $paginator->isEmpty()) {
            return self::whenEmpty();
        }

        return new self(
            total: $paginator->total(),
            firstItem: $paginator->firstItem() ?? 0,
            perPage: $paginator->perPage(),
            currentPage: $paginator->currentPage(),
            lastPage: $paginator->lastPage(),
        );
    }

    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'first_item' => $this->firstItem,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'last_page' => $this->lastPage,
        ];
    }
}
