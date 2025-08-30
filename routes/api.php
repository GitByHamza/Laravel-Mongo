<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/get-products', [ProductController::class, 'index']);   // Get all products
Route::get('/products/{id}', [ProductController::class, 'show']); // Get single product
Route::post('/create-product', [ProductController::class, 'store']);  // Create product
Route::put('/update-product/{id}', [ProductController::class, 'update']); // Update product
Route::delete('/delete-products/{id}', [ProductController::class, 'destroy']); // Delete product
