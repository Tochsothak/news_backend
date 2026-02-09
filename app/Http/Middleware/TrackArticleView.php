<?php

namespace App\Http\Middleware;

use App\Services\ArticleService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackArticleView
{
    public function __construct(private ArticleService $articleService) {}

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Track view only on successful article detail requests
        if ($response->getStatusCode() === 200 && $request->route('article')) {
            $article = $request->route('article');

            $this->articleService->recordView(
                $article,
                $request->user(),
                $request->ip(),
                $request->userAgent() ?? 'Unknown'
            );
        }

        return $response;
    }
}