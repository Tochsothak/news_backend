<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        if (!$request->user()->hasAnyPermission($permissions)) {
            return response()->json([
                'message' => 'Unauthorized. Required permission: ' . implode(' or ', $permissions),
            ], 403);
        }

        return $next($request);
    }
}