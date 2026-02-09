<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Reaction;
use App\Models\User;

class ReactionService
{
    /**
     * Add or update reaction
     */
    public function react(Article $article, User $user, string $type): array
    {
        $reaction = Reaction::updateOrCreate(
            [
                'user_id' => $user->id,
                'article_id' => $article->id,
            ],
            [
                'type' => $type,
            ]
        );

        return [
            'type' => $reaction->type,
            'message' => 'Reaction updated successfully',
        ];
    }

    /**
     * Remove reaction
     */
    public function removeReaction(Article $article, User $user): array
    {
        Reaction::where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->delete();

        return [
            'message' => 'Reaction removed successfully',
        ];
    }
}