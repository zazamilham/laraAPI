<?php

namespace App\APiService;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    public function success($data = null, $code = 200, $message = 'Successfully'): JsonResponse
    {
        return response()->json(['data' => $data, 'message' => $message], $code);
    }

    public function error($data = null, $code = 404, $message = 'Error'): JsonResponse
    {
        return response()->json(['data' => $data, 'message' => $message], $code);
    }

}
