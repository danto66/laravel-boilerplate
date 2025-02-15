<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\UserController;

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
});
