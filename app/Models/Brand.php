<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo_url',
        'country',
        'description',
    ];

    /**
     * Get all products for this brand
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
