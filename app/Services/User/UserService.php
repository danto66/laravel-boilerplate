<?php

namespace App\Services\User;

use App\DataTransferObjects\Base\QueryParamDto;
use App\Models\User;

class UserService
{
    public function getPaginated(QueryParamDto $query)
    {
        $users = User::query()
            ->orderBy($query->sort, $query->order)
            ->paginate(page: $query->page, perPage: $query->perPage);

        return $users;
    }
}
