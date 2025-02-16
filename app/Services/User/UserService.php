<?php

namespace App\Services\User;

use App\DataTransferObjects\Base\QueryParamDto;
use App\Models\Pipes\SearchBy;
use App\Models\User;
use Illuminate\Support\Facades\Pipeline;

class UserService
{
    public function getPaginated(QueryParamDto $query)
    {
        $users = Pipeline::send(User::query())
            ->through([
                new SearchBy(['name', 'email'], $query->search),
            ])
            ->thenReturn()
            ->orderBy($query->sort, $query->order)
            ->paginate(page: $query->page, perPage: $query->perPage);

        return $users;
    }
}
