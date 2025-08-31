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
    
    protected $casts = [
        'categories' => 'array',
        'sizes' => 'array',
        'ratings' => 'float',
        'price' => 'float',
        'stock' => 'integer',
        'is_featured' => 'boolean',
    ];
}