<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller
{

    /**
     * Handler for success responses
     *
     * @param integer $code
     * @param array $data
     *
     * @return Response
     */
    public function success($code, $data = [])
    {
        return response()->json([
            'data' => $data
        ], $code);
    }

    /**
     * Handler for error responses
     *
     * @param integer $code
     * @param string $message
     *
     * @return Response
     */
    public function error($code, $message)
    {
        return response()->json([
            'error' => [
                'message' => $message
            ]
        ], $code);
    }
}
