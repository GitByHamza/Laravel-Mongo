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
        $table->string('title'); // Product title
        $table->text('description'); // Product description
        $table->decimal('price', 10, 2); // Price (e.g., 9999.99)
        $table->enum('type', ['men', 'women']); // Gender type
        $table->json('categories')->nullable(); // Array of categories
        $table->json('sizes')->nullable(); // [S, M, L, XL]
        $table->string('images')->nullable(); // Product image path
        $table->float('rating')->default(0); // Average rating
        $table->integer('rating_count')->default(0); // Number of ratings
        $table->timestamps(); // created_at & updated_at
        $table->integer('stock')->default(0);
        $table->string('sku')->unique();
        $table->decimal('discount_price', 10, 2)->nullable();
        $table->enum('status', ['active', 'out_of_stock', 'archived'])->default('active');
        $table->string('brand')->nullable();
        $table->integer('views')->default(0);
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
