<?php

namespace App\Services\User;

use App\Models\User;
use App\DataTransferObjects\User\StoreUserDto;
use App\DataTransferObjects\Base\QueryParamDto;
use App\DataTransferObjects\User\FilterUserDto;
use App\DataTransferObjects\User\PatchUserDto;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function getPaginated(QueryParamDto $queryParam, FilterUserDto $filter): LengthAwarePaginator
    {
        $users = User::query()
            ->searchBy(['name', 'email'], $queryParam->search)
            ->filterByArray($filter->toArray())
            ->orderBy($queryParam->sort, $queryParam->order)
            ->paginate(page: $queryParam->page, perPage: $queryParam->perPage);

        return $users;
    }

    public function create(StoreUserDto $data): User
    {
        return User::create($data->toArray());
    }

    public function patch(User $user, PatchUserDto $data)
    {
        $user->update($data->toArray());

        return $user;
    }
}
