<?php

use App\Constants\Http\CodeConstant;
use App\Helpers\Http\ResponseJson;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if (request()->is('api/*')) {
            $exceptions->render(function (NotFoundHttpException $e, Request $request) {
                return ResponseJson::error(message: 'Not Found', code: CodeConstant::HTTP_NOT_FOUND);
            });
        }
    })->create();
