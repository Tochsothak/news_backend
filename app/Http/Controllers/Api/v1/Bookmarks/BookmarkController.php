<?php

namespace App\Http\Controllers\Api\V1\Bookmarks;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookmarkResource;
use App\Models\Article;
use App\Services\BookmarkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function __construct(private BookmarkService $bookmarkService) {}

    /**
     * Get user bookmarks
     */
    public function index(Request $request): JsonResponse
    {
        $bookmarks = $this->bookmarkService->getUserBookmarks(
            user: $request->user(),
            perPage: $request->input('per_page', 20)
        );

        return response()->json([
            'data' => BookmarkResource::collection($bookmarks),
            'meta' => [
                'total' => $bookmarks->total(),
                'current_page' => $bookmarks->currentPage(),
                'last_page' => $bookmarks->lastPage(),
            ],
        ]);
    }

    /**
     * Toggle bookmark
     */
    public function toggle(Article $article, Request $request): JsonResponse
    {
        $result = $this->bookmarkService->toggle(
            article: $article,
            user: $request->user()
        );

        return response()->json($result);
    }
}