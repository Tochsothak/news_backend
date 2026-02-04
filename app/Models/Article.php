<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasSlug;
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image_url',
        'author_id',
        'category_id',
        'status',
        'published_at',
        'views_count',
        'is_featured',
        'is_breaking_news',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_breaking_news' => 'boolean',
        'views_count' => 'integer',
    ];

    protected $appends = [
        'comments_count',
        'reactions_count',
    ];

    // Sluggable configuration
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->comments()->where('status', 'approved');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBreakingNews($query)
    {
        return $query->where('is_breaking_news', true);
    }

    public function scopeTrending($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    // Accessors
    public function getCommentsCountAttribute()
    {
        return $this->approvedComments()->count();
    }

    public function getReactionsCountAttribute()
    {
        return $this->reactions()->count();
    }

    public function getIsPublishedAttribute()
    {
        return $this->status === 'published'
            && $this->published_at
            && $this->published_at->isPast();
    }

    // Methods
    public function incrementViewsCount()
    {
        $this->increment('views_count');
    }

    public function isBookmarkedBy($userId)
    {
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    public function userReaction($userId)
    {
        return $this->reactions()->where('user_id', $userId)->first();
    }
}
