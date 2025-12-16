<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApiResponseSupport
{
    /**
     * @param string $message
     * @param bool|array $data
     * @param int $code
     *
     * @return JsonResponse
     */
    private function response(string $message, bool|array $data = [], int $code = 200): JsonResponse
    {
        $response = [
            'success' => $code == 200,
            'message' => $message,
            'version' => config('app.api_version')
        ];

        if (is_array($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    /**
     * @param string $message
     * @param array|bool $data
     * @param int $code
     * @return JsonResponse
     */
    public function success(string $message, array|bool $data = [], int $code = 200): JsonResponse
    {
        return $this->response($message, $data, $code);
    }

    /**
     * @param string $message
     * @param bool|array $data
     * @param int $code
     *
     * @return JsonResponse
     */
    public function error(string $message, bool|array $data = [], int $code = 500): JsonResponse
    {
        return $this->response($message, $data, $code);
    }

    /**
     * @param string $message
     * @param bool|array $data
     * @param int $code
     *
     * @return JsonResponse
     */
    public function auth(string $message, bool|array $data = [], int $code = 401): JsonResponse
    {
        return $this->response($message, $data, $code);
    }

    /**
     * @param string $message
     * @param bool|array $data
     * @param int $code
     *
     * @return JsonResponse
     */
    public function validation(string $message, bool|array $data = [], int $code = 422): JsonResponse
    {
        return $this->response($message, $data, $code);
    }

    /**
     * @param string $message
     * @param bool|array $data
     * @param int $code
     *
     * @return JsonResponse
     */
    public function notFound(string $message, bool|array $data = [], int $code = 404): JsonResponse
    {
        return $this->response($message, $data, $code);
    }

    /**
     * @param string $file_path
     * @return BinaryFileResponse|null
     */
    public function getFile(string $file_path): BinaryFileResponse|null
    {
        return response()->download($file_path)->deleteFileAfterSend();
    }
}
