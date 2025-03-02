<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\DataTransferObjects\Base\MetaDto;
use App\DataTransferObjects\Base\QueryParamDto;
use App\DataTransferObjects\User\FilterUserDto;
use App\DataTransferObjects\User\StoreUserDto;
use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Http\Resources\Api\V1\User\UsersResource;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(Request $request)
    {
        $users = $this->userService->getPaginated(
            QueryParamDto::fromRequest($request),
            FilterUserDto::fromRequest($request),
        );

        return $this->jsonSuccess(
            data: UsersResource::collection($users),
            meta: MetaDto::fromPaginator($users),
        );
    }

    public function show(User $user)
    {
        return $this->jsonSuccess(
            data: UserResource::make($user),
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create(StoreUserDto::fromRequest($request));

        return $this->jsonSuccess(
            data: UserResource::make($user),
        );
    }
}
