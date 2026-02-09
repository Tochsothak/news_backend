<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class CommentService
{
    /**
     * Get article comments
     */
    public function getArticleComments(Article $article, int $perPage = 20)
    {
        return Comment::with(['user', 'replies.user'])
            ->where('article_id', $article->id)
            ->rootComments()
            ->approved()
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Create comment
     */
    public function createComment(Article $article, User $user, array $data): Comment
    {
        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'content' => $data['content'],
            'parent_id' => $data['parent_id'] ?? null,
            'status' => 'pending', // Auto-approve for now, or use moderation
        ]);

        return $comment->load('user');
    }

    /**
     * Update comment
     */
    public function updateComment(Comment $comment, array $data): Comment
    {
        $comment->update([
            'content' => $data['content'],
        ]);

        return $comment;
    }

    /**
     * Delete comment
     */
    public function deleteComment(Comment $comment): bool
    {
        return $comment->delete();
    }

    /**
     * Approve comment
     */
    public function approveComment(Comment $comment): Comment
    {
        $comment->update(['status' => 'approved']);
        return $comment;
    }

    /**
     * Reject comment
     */
    public function rejectComment(Comment $comment): Comment
    {
        $comment->update(['status' => 'rejected']);
        return $comment;
    }

    /**
     * Get pending comments
     */
    public function getPendingComments(int $perPage = 20)
    {
        return Comment::with(['user', 'article'])
            ->where('status', 'pending')
            ->latest()
            ->paginate($perPage);
    }
}