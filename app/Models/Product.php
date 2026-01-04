<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'stock',
        'category_id',
        'is_active',
        'is_featured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
