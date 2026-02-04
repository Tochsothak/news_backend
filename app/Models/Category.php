<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'image_url',
        'status',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Sluggable configuration
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    // Relationships
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function publishedArticles()
    {
        return $this->articles()
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // Accessors
    public function getArticlesCountAttribute()
    {
        return $this->publishedArticles()->count();
    }
}
