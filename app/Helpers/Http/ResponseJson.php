<?php

namespace App\Helpers\Http;

use App\Constants\Http\CodeConstant;
use App\DataTransferObjects\Base\MetaDto;

class ResponseJson
{
    public static function success($data = null, $message = 'Success', ?MetaDto $meta = null, $code = CodeConstant::HTTP_OK)
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

    public static function error($message = 'Error', $errors = [], $code = CodeConstant::HTTP_INTERNAL_SERVER_ERROR, $debug = null)
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
