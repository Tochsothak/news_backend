<?php

namespace App\Http\Controllers\Api\V1\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService) {}

    /**
     * Get all published articles
     */
    public function index(Request $request): ArticleCollection
    {
        $articles = $this->articleService->getPublishedArticles(
            perPage: $request->input('per_page', 20)
        );

        return new ArticleCollection($articles);
    }

    /**
     * Get single article by slug
     */
    public function show(string $slug): ArticleResource
    {
        $article = Article::with(['author', 'category', 'tags', 'comments.user', 'comments.replies.user'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return new ArticleResource($article);
    }

    /**
     * Get articles by category
     */
    public function byCategory(string $slug, Request $request): ArticleCollection
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = $this->articleService->getPublishedArticles(
            perPage: $request->input('per_page', 20),
            categoryId: $category->id
        );

        return new ArticleCollection($articles);
    }

    /**
     * Get articles by tag
     */
    public function byTag(string $slug, Request $request): ArticleCollection
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $articles = $this->articleService->getPublishedArticles(
            perPage: $request->input('per_page', 20),
            tagId: $tag->id
        );

        return new ArticleCollection($articles);
    }

    /**
     * Get trending articles
     */
    public function trending(Request $request): JsonResponse
    {
        $articles = $this->articleService->getTrendingArticles(
            limit: $request->input('limit', 10)
        );

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /**
     * Get featured articles
     */
    public function featured(Request $request): JsonResponse
    {
        $articles = $this->articleService->getFeaturedArticles(
            limit: $request->input('limit', 5)
        );

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /**
     * Get breaking news
     */
    public function breakingNews(Request $request): JsonResponse
    {
        $articles = $this->articleService->getBreakingNews(
            limit: $request->input('limit', 3)
        );

        return response()->json([
            'data' => ArticleResource::collection($articles),
        ]);
    }

    /**
     * Search articles
     */
    public function search(Request $request): ArticleCollection
    {
        $request->validate([
            'q' => 'required|string|min:2',
        ]);

        $articles = $this->articleService->searchArticles(
            query: $request->input('q'),
            perPage: $request->input('per_page', 20)
        );

        return new ArticleCollection($articles);
    }

    /**
     * Create new article
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $article = $this->articleService->createArticle(
            data: $request->validated(),
            author: $request->user()
        );

        return response()->json([
            'message' => 'Article created successfully',
            'data' => new ArticleResource($article),
        ], 201);
    }

    /**
     * Update article
     */
    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $article = $this->articleService->updateArticle(
            article: $article,
            data: $request->validated()
        );

        return response()->json([
            'message' => 'Article updated successfully',
            'data' => new ArticleResource($article),
        ]);
    }

    /**
     * Delete article
     */
    public function destroy(Article $article): JsonResponse
    {
        // Check authorization
        if (!$article->author_id === auth()->id() && !auth()->user()->can('delete_all_articles')) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $this->articleService->deleteArticle($article);

        return response()->json([
            'message' => 'Article deleted successfully',
        ]);
    }

    /**
     * Publish article
     */
    public function publish(Article $article): JsonResponse
    {
        $article = $this->articleService->publishArticle($article);

        return response()->json([
            'message' => 'Article published successfully',
            'data' => new ArticleResource($article),
        ]);
    }

    /**
     * Unpublish article
     */
    public function unpublish(Article $article): JsonResponse
    {
        $article->update(['status' => 'draft']);

        return response()->json([
            'message' => 'Article unpublished successfully',
            'data' => new ArticleResource($article),
        ]);
    }

    /**
     * Schedule article
     */
    public function schedule(Request $request, Article $article): JsonResponse
    {
        $request->validate([
            'published_at' => 'required|date|after:now',
        ]);

        $article = $this->articleService->scheduleArticle(
            article: $article,
            publishedAt: $request->input('published_at')
        );

        return response()->json([
            'message' => 'Article scheduled successfully',
            'data' => new ArticleResource($article),
        ]);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Article $article): JsonResponse
    {
        $article = $this->articleService->toggleFeatured($article);

        return response()->json([
            'message' => $article->is_featured
                ? 'Article marked as featured'
                : 'Article unmarked as featured',
            'data' => new ArticleResource($article),
        ]);
    }

    /**
     * Toggle breaking news status
     */
    public function toggleBreakingNews(Article $article): JsonResponse
    {
        $article = $this->articleService->toggleBreakingNews($article);

        return response()->json([
            'message' => $article->is_breaking_news
                ? 'Article marked as breaking news'
                : 'Article unmarked as breaking news',
            'data' => new ArticleResource($article),
        ]);
    }

    /**
     * Get my articles (author's own articles)
     */
    public function myArticles(Request $request): ArticleCollection
    {
        $articles = Article::with(['category', 'tags'])
            ->where('author_id', $request->user()->id)
            ->latest()
            ->paginate($request->input('per_page', 20));

        return new ArticleCollection($articles);
    }
}
