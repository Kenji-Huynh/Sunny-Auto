<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author_id',
        'category_id',
        'status',
        'views_count',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer'
    ];

    /**
     * Automatically generate slug from title
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the author (user) of the post
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the category of the post
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * Get all comments for this post
     */
    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'post_id');
    }

    /**
     * Get approved comments only
     */
    public function approvedComments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'post_id')
                    ->where('status', 'approved')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Scope to get published posts only
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now())
                     ->orderBy('published_at', 'desc');
    }

    /**
     * Scope to get draft posts
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Increment view count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get formatted published date
     */
    public function getPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    /**
     * Get reading time estimate (in minutes)
     */
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200); // Average reading speed
        return $minutes;
    }
}
