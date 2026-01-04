<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            // Foreign key (optional if we want strictness, for now just index is fine but FK is better)
            // But since categories migration runs AFTER products? No, 2026_01_03_120912 vs 120911.
            // Products is 120911, Categories is 120912.
            // Wait, products 11, categories 12. Products runs first.
            // So if I add FK constraint, it might fail if categories table doesn't exist yet.
            // Actually I should reorder migrations or just rely on late binding, but standard approach is:
            // create categories FIRST, then products.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
