<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;

Route::get('/debug-categories', function () {
    return Category::all(['id', 'name', 'slug']);
});
