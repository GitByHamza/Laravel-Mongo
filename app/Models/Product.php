<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'sku', 'title', 'description', 'price', 'type', 'categories', 'image',
        'sizes', 'ratings', 'stock', 'discount', 'is_featured', 'status',
        'brand', 'views'
    ];
    
    // // 👇 1. ADD THIS PROPERTY BACK
    // protected $appends = ['id'];

    protected $casts = [
        'categories' => 'array',
        'sizes' => 'array',
        'ratings' => 'float',
        'price' => 'float',
        'stock' => 'integer',
        'is_featured' => 'boolean',
    ];

    // 👇 2. ADD THIS NEW-AND-IMPROVED FUNCTION
    // This uses Eloquent's official getKey() method, which is the most reliable
    // way to get the model's primary key (_id).
    // public function getIdAttribute($value = null)
    // {
    //     return $this->getKey();
    // }
}