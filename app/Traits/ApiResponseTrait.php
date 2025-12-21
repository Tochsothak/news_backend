<?php

namespace App\Traits;

use App\Helpers\ServiceResponse;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Convert ServiceResponse to JsonResponse
     * PRIMARY METHOD - Use with service layer
     */
    protected function respond(ServiceResponse $serviceResponse): JsonResponse
    {
        return $serviceResponse->toJsonResponse();
    }

    /**
     * Quick Success Response (without service layer)
     */
    protected function success($data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Quick Error Response (without service layer)
     */
    protected function error(string $message = 'Error', int $statusCode = 400, $errors = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    // Convenience methods that delegate to error()
    protected function validationError($errors, string $message = 'Validation failed'): JsonResponse
    {
        return $this->error($message, 422, $errors);
    }

    protected function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return $this->error($message, 404);
    }

    protected function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->error($message, 401);
    }

    protected function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->error($message, 403);
    }

    protected function serverError(string $message = 'Internal server error'): JsonResponse
    {
        return $this->error($message, 500);
    }

    protected function conflict(string $message = 'Resource conflict'): JsonResponse
    {
        return $this->error($message, 409);
    }

    protected function tooManyRequests(string $message = 'Too many requests'): JsonResponse
    {
        return $this->error($message, 429);
    }
}
