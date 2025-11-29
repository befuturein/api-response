<?php

namespace BeFuture\ApiResponse;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    public static function success(array $data = [], ?string $message = null, string $code = 'OK', int $httpStatus = 200, array $meta = []): JsonResponse
    {
        return self::make(true, $code, $message ?? 'OK', $data, $meta, $httpStatus);
    }

    public static function error(string $message, string $code = 'ERROR', int $httpStatus = 400, array $data = [], array $meta = []): JsonResponse
    {
        return self::make(false, $code, $message, $data, $meta, $httpStatus);
    }

    public static function validationError(array $errors, string $message = 'Validation error', string $code = 'VALIDATION_ERROR', int $httpStatus = 422, array $meta = []): JsonResponse
    {
        return self::make(false, $code, $message, ['errors' => $errors], $meta, $httpStatus);
    }

    protected static function make(bool $success, string $code, string $message, array $data, array $meta, int $httpStatus): JsonResponse
    {
        $body = [
            'success' => $success,
            'code'    => $code,
            'message' => $message,
            'data'    => (object) $data,
            'meta'    => (object) $meta,
        ];

        return new JsonResponse($body, $httpStatus);
    }
}
