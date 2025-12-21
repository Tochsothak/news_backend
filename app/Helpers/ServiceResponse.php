<?php

namespace App\Helpers;

class ServiceResponse
{
    public bool $success;
    public string $message;
    public mixed $data;
    public int $statusCode;
    public array $errors;
    public array $meta;

    public function __construct(
        bool $success,
        string $message,
        mixed $data = null,
        int $statusCode = 200,
        array $errors = [],
        array $meta = []
    ) {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->errors = $errors;
        $this->meta = $meta;
    }

    // Success responses
    public static function success(mixed $data = null, string $message = 'Success', int $statusCode = 200): self
    {
        return new self(true, $message, $data, $statusCode); // ✅ Fixed order
    }

    public static function created(mixed $data = null, string $message = 'Resource created successfully'): self
    {
        return new self(true, $message, $data, 201);
    }

    public static function updated(mixed $data = null, string $message = 'Resource updated successfully'): self
    {
        return new self(true, $message, $data, 200);
    }

    public static function deleted(string $message = 'Resource deleted successfully'): self
    {
        return new self(true, $message, null, 200);
    }

    // Error responses
    public static function error(string $message = 'Error', int $statusCode = 400, mixed $data = null): self
    {
        return new self(false, $message, $data, $statusCode);
    }

    public static function validationError(array $errors, string $message = 'Validation failed'): self
    {
        return new self(false, $message, null, 422, $errors);
    }

    public static function notFound(string $message = 'Resource not found'): self
    {
        return new self(false, $message, null, 404);
    }

    public static function unauthorized(string $message = 'Unauthorized'): self
    {
        return new self(false, $message, null, 401);
    }

    public static function forbidden(string $message = 'Forbidden'): self
    {
        return new self(false, $message, null, 403);
    }

    public static function serverError(string $message = 'Internal server error'): self
    {
        return new self(false, $message, null, 500);
    }

    // Fluent methods for chaining
    public function withMeta(array $meta): self
    {
        $this->meta = array_merge($this->meta, $meta);
        return $this;
    }

    public function withPagination($paginator): self
    {
        // ✅ Added links for consistency with ApiResponseTrait
        $this->meta = array_merge($this->meta, [
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ]
        ]);
        return $this;
    }

    public function withErrors(array $errors): self
    {
        $this->errors = array_merge($this->errors, $errors);
        return $this;
    }

    // Convert to array
    public function toArray(): array
    {
        $response = [
            'success' => $this->success,
            'message' => $this->message,
        ];

        if ($this->data !== null) {
            $response['data'] = $this->data;
        }

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        if (!empty($this->meta)) {
            $response['meta'] = $this->meta;
        }

        return $response;
    }

    // Convert to JSON
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    // Laravel HTTP Response (for API)
    public function toJsonResponse()
    {
        return response()->json($this->toArray(), $this->statusCode);
    }

    // For Blade views (redirect with flash messages)
    public function toRedirect(string $route)
    {
        if ($this->success) {
            return redirect()->route($route)
                ->with('success', $this->message)
                ->with('data', $this->data);
        }

        return redirect()->back()
            ->withErrors($this->errors ?: ['error' => $this->message])
            ->withInput();
    }

    // For Blade views (return view with data)
    public function toView(string $view, array $additionalData = [])
    {
        return view($view, array_merge([
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
            'meta' => $this->meta,
        ], $additionalData));
    }

    // Check if response is successful
    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function isError(): bool
    {
        return !$this->success;
    }
}
