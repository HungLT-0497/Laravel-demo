<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function successResponse($message, $data): \Illuminate\Http\JsonResponse
    {
        $statusCode = 200;
        return response()->json(compact('data', 'message', 'statusCode'),200);
    }
    public function errorResponse($message): \Illuminate\Http\JsonResponse
    {
        $statusCode = 400;
        return response()->json(compact( 'message', 'statusCode'),200);
    }
}
