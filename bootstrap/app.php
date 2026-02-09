<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: 'api',  // API route prefix
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // ============================================
        // MIDDLEWARE ALIASES
        // ============================================
        //
        $middleware->alias([
            // Custom Role & Permission Middleware
            'role' => \App\Http\Middleware\CheckRole::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'track.view' => \App\Http\Middleware\TrackArticleView::class,

            // You can add more aliases here
            // 'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        //
        // ============================================
        // API MIDDLEWARE STACK
        // ============================================
        //
        // Customize middleware that runs on API routes
        //
        $middleware->api(prepend: [
            // Ensure frontend requests are stateful (for SPA with Sanctum)
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        // If you want to throttle API requests
        $middleware->api(append: [
            // 'throttle:api',  // Uncomment to enable API throttling
        ]);

        //
        // ============================================
        // WEB MIDDLEWARE STACK
        // ============================================
        //
        // Customize middleware that runs on web routes
        //
        // $middleware->web(append: [
        //     // Add custom web middleware
        // ]);

        //
        // ============================================
        // GLOBAL MIDDLEWARE
        // ============================================
        //
        // Runs on EVERY request (use sparingly)
        //
        // $middleware->append([
        //     // \App\Http\Middleware\LogRequests::class,
        // ]);

        //
        // ============================================
        // MIDDLEWARE PRIORITY
        // ============================================
        //
        // Define the order in which middleware should run
        //
        $middleware->priority([
            \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Auth\Middleware\Authorize::class,
        ]);

        //
        // ============================================
        // CUSTOM MIDDLEWARE GROUPS
        // ============================================
        //
        // Create custom middleware groups
        //
        $middleware->group('admin', [
            'auth:sanctum',
            'role:admin|super_admin',
        ]);

        $middleware->group('author', [
            'auth:sanctum',
            'role:author|editor|admin|super_admin',
        ]);

        //
        // ============================================
        // TRUSTY PROXIES & HOSTS
        // ============================================
        //
        // Configure trusted proxies (important for production behind load balancer)
        //
        // $middleware->trustProxies(at: '*');
        // $middleware->trustHosts(at: ['example.com', 'www.example.com']);

        //
        // ============================================
        // PREVENT STRAY REQUESTS
        // ============================================
        //
        // Prevent access from unauthorized hosts in production
        //
        // $middleware->preventRequestsDuringMaintenance(except: [
        //     '/admin/*',
        // ]);

        //
        // ============================================
        // VALIDATE CSRF TOKENS EXCEPT
        // ============================================
        //
        $middleware->validateCsrfTokens(except: [
            'stripe/*',  // Example: Stripe webhooks
            'webhook/*', // Your custom webhooks
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        // ============================================
        // EXCEPTION HANDLING
        // ============================================
        //

        // Customize 404 responses for API
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Resource not found',
                ], 404);
            }
        });

        // Handle other exceptions
        // $exceptions->renderable(function (Throwable $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'message' => 'Server error',
        //             'error' => $e->getMessage(),
        //         ], 500);
        //     }
        // });
    })->create();