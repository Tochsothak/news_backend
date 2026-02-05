<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->when($request->routeIs('*.show'), $this->content),
            'featured_image_url' => $this->featured_image_url,
            'status' => $this->status,
            'published_at' => $this->published_at?->toISOString(),
            'views_count' => $this->views_count,
            'comments_count' => $this->comments_count,
            'reactions_count' => $this->reactions_count,
            'is_featured' => $this->is_featured,
            'is_breaking_news' => $this->is_breaking_news,

            // Relationships
            'author' => new UserResource($this->whenLoaded('author')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),

            // User-specific data (when authenticated)
            'is_bookmarked' => $this->when(
                $request->user(),
                fn() => $this->isBookmarkedBy($request->user()->id)
            ),
            'user_reaction' => $this->when(
                $request->user(),
                fn() => $this->userReaction($request->user()->id)?->type
            ),

            // SEO (only in detail view)
            'meta_title' => $this->when($request->routeIs('*.show'), $this->meta_title),
            'meta_description' => $this->when($request->routeIs('*.show'), $this->meta_description),
            'meta_keywords' => $this->when($request->routeIs('*.show'), $this->meta_keywords),

            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
