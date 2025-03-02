<?php

namespace App\Services\User;

use App\DataTransferObjects\Base\QueryParamDto;
use App\DataTransferObjects\User\FilterUserDto;
use App\Models\User;

class UserService
{
    public function getPaginated(QueryParamDto $queryParam, FilterUserDto $filter)
    {
        $users = User::query()
            ->searchBy(['name', 'email'], $queryParam->search)
            ->filterByArray($filter->toArray())
            ->orderBy($queryParam->sort, $queryParam->order)
            ->paginate(page: $queryParam->page, perPage: $queryParam->perPage);

        return $users;
    }
}
