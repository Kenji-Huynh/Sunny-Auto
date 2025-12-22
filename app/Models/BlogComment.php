<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogComment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'author_name',
        'author_email',
        'content',
        'status'
    ];

    /**
     * Get the post this comment belongs to
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }

    /**
     * Get the user who commented (if logged in)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get approved comments only
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved')
                     ->orderBy('created_at', 'desc');
    }

    /**
     * Scope to get pending comments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending')
                     ->orderBy('created_at', 'desc');
    }

    /**
     * Get comment author name
     */
    public function getAuthorDisplayNameAttribute()
    {
        return $this->user ? $this->user->name : $this->author_name;
    }
}
