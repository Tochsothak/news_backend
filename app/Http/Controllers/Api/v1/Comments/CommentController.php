<?php

namespace App\Http\Controllers\Api\V1\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private CommentService $commentService) {}

    /**
     * Get article comments
     */
    public function index(Article $article, Request $request): JsonResponse
    {
        $comments = $this->commentService->getArticleComments(
            article: $article,
            perPage: $request->input('per_page', 20)
        );

        return response()->json([
            'data' => CommentResource::collection($comments),
            'meta' => [
                'total' => $comments->total(),
                'current_page' => $comments->currentPage(),
                'last_page' => $comments->lastPage(),
            ],
        ]);
    }

    /**
     * Create comment
     */
    public function store(StoreCommentRequest $request, Article $article): JsonResponse
    {
        $comment = $this->commentService->createComment(
            article: $article,
            user: $request->user(),
            data: $request->validated()
        );

        return response()->json([
            'message' => 'Comment posted successfully',
            'data' => new CommentResource($comment),
        ], 201);
    }

    /**
     * Update comment
     */
    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        $comment = $this->commentService->updateComment(
            comment: $comment,
            data: $request->validated()
        );

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => new CommentResource($comment),
        ]);
    }

    /**
     * Delete comment
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $this->commentService->deleteComment($comment);

        return response()->json([
            'message' => 'Comment deleted successfully',
        ]);
    }

    /**
     * Get pending comments (for moderation)
     */
    public function pending(Request $request): JsonResponse
    {
        $comments = $this->commentService->getPendingComments(
            perPage: $request->input('per_page', 20)
        );

        return response()->json([
            'data' => CommentResource::collection($comments),
            'meta' => [
                'total' => $comments->total(),
                'current_page' => $comments->currentPage(),
                'last_page' => $comments->lastPage(),
            ],
        ]);
    }

    /**
     * Approve comment
     */
    public function approve(Comment $comment): JsonResponse
    {
        $comment = $this->commentService->approveComment($comment);

        return response()->json([
            'message' => 'Comment approved successfully',
            'data' => new CommentResource($comment),
        ]);
    }

    /**
     * Reject comment
     */
    public function reject(Comment $comment): JsonResponse
    {
        $comment = $this->commentService->rejectComment($comment);

        return response()->json([
            'message' => 'Comment rejected successfully',
            'data' => new CommentResource($comment),
        ]);
    }
}
