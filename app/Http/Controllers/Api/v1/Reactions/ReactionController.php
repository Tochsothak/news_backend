<?php

namespace App\Http\Controllers\Api\V1\Reactions;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ReactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function __construct(private ReactionService $reactionService) {}

    /**
     * Add or update reaction to an article
     *
     * @param Request $request
     * @param Article $article
     * @return JsonResponse
     */
    public function store(Request $request, Article $article): JsonResponse
    {
        $request->validate([
            'type' => ['required', 'in:like,love,wow,sad,angry'],
        ]);

        $result = $this->reactionService->react(
            article: $article,
            user: $request->user(),
            type: $request->input('type')
        );

        return response()->json($result);
    }

    /**
     * Remove reaction from an article
     *
     * @param Request $request
     * @param Article $article
     * @return JsonResponse
     */
    public function destroy(Request $request, Article $article): JsonResponse
    {
        $result = $this->reactionService->removeReaction(
            article: $article,
            user: $request->user()
        );

        return response()->json($result);
    }

    /**
     * Get article reactions summary
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function index(Article $article): JsonResponse
    {
        $reactions = $article->reactions()
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type');

        return response()->json([
            'data' => [
                'total' => $reactions->sum(),
                'breakdown' => $reactions,
            ],
        ]);
    }
}