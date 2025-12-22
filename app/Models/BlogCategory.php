<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * Get all posts in this category
     */
    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    /**
     * Get published posts count
     */
    public function getPublishedPostsCountAttribute()
    {
        return $this->posts()->where('status', 'published')->count();
    }
}
