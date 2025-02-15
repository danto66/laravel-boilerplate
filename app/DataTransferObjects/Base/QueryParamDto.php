<?php

namespace App\DataTransferObjects\Base;

use App\DataTransferObjects\Contracts\FromRequest;
use Illuminate\Http\Request;

readonly class QueryParamDto implements FromRequest
{
    public function __construct(
        public int $page,
        public int $perPage,
        public string $search,
        public string $sort,
        public string $order,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $sort = $request->query('sort') ?? 'created_at';

        if (str_contains($sort, ',')) {
            [$sort, $order] = explode(',', $sort);
        } else {
            $order = 'desc';
        }

        return new self(
            page: $request->query('page') ?? 1,
            perPage: $request->query('per_page') ?? 20,
            search: $request->query('search') ?? '',
            sort: $sort,
            order: $order,
        );
    }
}
