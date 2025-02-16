<?php

namespace App\Services\User;

use App\DataTransferObjects\Base\QueryParamDto;
use App\Models\Pipes\SearchBy;
use App\Models\User;
use Illuminate\Support\Facades\Pipeline;

class UserService
{
    public function getPaginated(QueryParamDto $queryParam)
    {
        $users = Pipeline::send(User::query())
            ->through([
                new SearchBy(['name', 'email'], $queryParam->search),
            ])
            ->thenReturn()
            ->orderBy($queryParam->sort, $queryParam->order)
            ->paginate(page: $queryParam->page, perPage: $queryParam->perPage);

        return $users;
    }
}
