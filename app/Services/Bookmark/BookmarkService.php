<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Bookmark;
use App\Models\User;

class BookmarkService
{
    /**
     * Toggle bookmark
     */
    public function toggle(Article $article, User $user): array
    {
        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return [
                'bookmarked' => false,
                'message' => 'Article removed from bookmarks',
            ];
        }

        Bookmark::create([
            'user_id' => $user->id,
            'article_id' => $article->id,
        ]);

        return [
            'bookmarked' => true,
            'message' => 'Article bookmarked successfully',
        ];
    }

    /**
     * Get user bookmarks
     */
    public function getUserBookmarks(User $user, int $perPage = 20)
    {
        return Bookmark::with(['article.author', 'article.category'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);
    }
}