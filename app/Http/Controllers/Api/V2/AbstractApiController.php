<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *      version="2.0.0",
 *      title="Google Ads App Version 2",
 *      description="Google Ads App project",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      )
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   in="header",
 *   name="Authorization",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT",
 * )
 *
 */

abstract class AbstractApiController extends Controller
{
    /**
     * Response JSON format
     *
     * @param  string $message
     * @param  int $code
     * @param  array $data
     * @param  string | array $error
     *
     * @return JsonResponse
     */
    protected function responseJSON(string $message, int $code = 200, array $data = []): JsonResponse
    {
        $json = [
            'success'   => $code == 200 ? true : false,
            'message'   => $message,
            'version'   => 'v2',
            'data'      => []
        ];
        if(!empty($data)) $json['data'] = $data;
        return response()->json($json, $code);
    }
}
