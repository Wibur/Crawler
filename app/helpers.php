<?php

use Illuminate\Http\Response;

if (!function_exists('errorResponse')) {

    /**
     * 錯誤回傳
     * 紀錄log
     * @param int $code 預設400
     * @param $trace
     * @return Response
     */
    function errorResponse($code, $trace)
    {
        $code = ($code == 0 || $code == null) ? 400 : $code;
        $response = new Response();
        logger($trace);

        return ($code === 400 || $code === 404) ?
            response()->json($trace->getMessage(), $code, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $response->setStatusCode($code);
    }
}