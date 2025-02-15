<?php

namespace App\Http\Controllers\Api\V1\User;

use App\DataTransferObjects\Base\MetaDto;
use App\DataTransferObjects\Base\QueryParamDto;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\UsersResource;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(Request $request)
    {
        $users = $this->userService->getPaginated(QueryParamDto::fromRequest($request));

        return $this->jsonSuccess(
            data: UsersResource::collection($users),
            meta: MetaDto::fromPaginator($users),
        );
    }
}
