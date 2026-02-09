<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ArticleService
{
    /**
     * Get published articles with pagination
     */
    public function getPublishedArticles(int $perPage = 20, ?int $categoryId = null, ?int $tagId = null)
    {
        $query = Article::with(['author', 'category', 'tags'])
            ->published()
            ->recent();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($tagId) {
            $query->whereHas('tags', fn($q) => $q->where('tags.id', $tagId));
        }

        return $query->paginate($perPage);
    }

    /**
     * Get trending articles (most viewed in last 7 days)
     */
    public function getTrendingArticles(int $limit = 10)
    {
        return Cache::remember('trending_articles', 3600, function () use ($limit) {
            return Article::with(['author', 'category'])
                ->published()
                ->where('published_at', '>=', now()->subDays(7))
                ->trending()
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get featured articles
     */
    public function getFeaturedArticles(int $limit = 5)
    {
        return Cache::remember('featured_articles', 3600, function () use ($limit) {
            return Article::with(['author', 'category'])
                ->published()
                ->featured()
                ->recent()
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get breaking news
     */
    public function getBreakingNews(int $limit = 3)
    {
        return Cache::remember('breaking_news', 600, function () use ($limit) {
            return Article::with(['author', 'category'])
                ->published()
                ->breakingNews()
                ->recent()
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Create new article
     */
    public function createArticle(array $data, User $author): Article
    {
        return DB::transaction(function () use ($data, $author) {
            $article = Article::create([
                ...$data,
                'author_id' => $author->id,
                'status' => $data['status'] ?? 'draft',
            ]);

            // Attach tags if provided
            if (!empty($data['tags'])) {
                $article->tags()->sync($data['tags']);
            }

            // Clear cache
            $this->clearArticleCache();

            return $article->load(['author', 'category', 'tags']);
        });
    }

    /**
     * Update article
     */
    public function updateArticle(Article $article, array $data): Article
    {
        return DB::transaction(function () use ($article, $data) {
            $article->update($data);

            // Update tags if provided
            if (isset($data['tags'])) {
                $article->tags()->sync($data['tags']);
            }

            // Clear cache
            $this->clearArticleCache();

            return $article->load(['author', 'category', 'tags']);
        });
    }

    /**
     * Delete article
     */
    public function deleteArticle(Article $article): bool
    {
        $this->clearArticleCache();
        return $article->delete();
    }

    /**
     * Publish article
     */
    public function publishArticle(Article $article): Article
    {
        $article->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->clearArticleCache();

        return $article;
    }

    /**
     * Schedule article
     */
    public function scheduleArticle(Article $article, string $publishedAt): Article
    {
        $article->update([
            'status' => 'scheduled',
            'published_at' => $publishedAt,
        ]);

        return $article;
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Article $article): Article
    {
        $article->update([
            'is_featured' => !$article->is_featured,
        ]);

        $this->clearArticleCache();

        return $article;
    }

    /**
     * Toggle breaking news status
     */
    public function toggleBreakingNews(Article $article): Article
    {
        $article->update([
            'is_breaking_news' => !$article->is_breaking_news,
        ]);

        $this->clearArticleCache();

        return $article;
    }

    /**
     * Record article view
     */
    public function recordView(Article $article, ?User $user, string $ipAddress, string $userAgent): void
    {
        // Prevent duplicate views from same user/IP in 24 hours
        $key = $user ? "view_article_{$article->id}_user_{$user->id}" : "view_article_{$article->id}_ip_{$ipAddress}";

        if (Cache::has($key)) {
            return;
        }

        ArticleView::create([
            'article_id' => $article->id,
            'user_id' => $user?->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'viewed_at' => now(),
        ]);

        $article->incrementViewsCount();

        // Cache for 24 hours
        Cache::put($key, true, 86400);
    }

    /**
     * Search articles
     */
    public function searchArticles(string $query, int $perPage = 20)
    {
        return Article::with(['author', 'category', 'tags'])
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('content', 'LIKE', "%{$query}%")
                    ->orWhere('excerpt', 'LIKE', "%{$query}%");
            })
            ->recent()
            ->paginate($perPage);
    }

    /**
     * Clear article cache
     */
    private function clearArticleCache(): void
    {
        Cache::forget('trending_articles');
        Cache::forget('featured_articles');
        Cache::forget('breaking_news');
    }
}