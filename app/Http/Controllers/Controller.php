<?php

namespace App\Http\Controllers;

use App\Constants\Http\CodeConstant;
use App\DataTransferObjects\Base\MetaDto;

abstract class Controller
{
    protected function jsonSuccess($data = null, $message = 'Success', ?MetaDto $meta = null, $code = CodeConstant::HTTP_OK)
    {
        $body = [
            'message' => $message,
            'data' => $data,
        ];

        if (!empty($meta)) {
            $body['meta'] = $meta->toArray();
        }

        return response()->json($body, $code);
    }

    protected function jsonError($message = 'Error', $errors = [], $code = CodeConstant::HTTP_INTERNAL_SERVER_ERROR, $debug = null)
    {
        $body = [
            'message' => $message,
            'errors' => $errors,
        ];

        if ($debug && config('app.debug')) {
            $body['debug'] = $debug;
        }

        return response()->json($body, $code);
    }
}
