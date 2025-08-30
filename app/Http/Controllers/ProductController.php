<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            $product->id = (string) $product->_id; // convert ObjectId to string
            unset($product->_id); // optional: remove original _id
            return $product;
        });

        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add all other fields from your model for more robust validation
        $validated = $request->validate([
            'sku'       => 'required|string|unique:products,sku',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'type'        => 'required|string',
            'categories'  => 'required|array',
            'sizes'       => 'required|array',
            'image'       => 'required|string',
            'stock'       => 'required|integer|min:0',
            'discount'    => 'nullable|numeric|min:0',
            'is_featured' => 'sometimes|boolean',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->id = (string) $product->_id;
            unset($product->_id);
        }
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        // Tell the unique rule to ignore the current product's ID
        'sku'         => 'required|string|unique:products,sku,' . $product->id . ',_id', // 👈 Crucial change
        'title'       => 'sometimes|required|string|max:255',
        'description' => 'sometimes|required|string',
        'price'       => 'sometimes|required|numeric|min:0',
        'type'        => 'sometimes|required|string',
        'categories'  => 'sometimes|required|array',
        'sizes'       => 'sometimes|required|array',
        'image'       => 'sometimes|required|string',
        'stock'       => 'sometimes|required|integer|min:0',
        'discount'    => 'nullable|numeric|min:0',
        'is_featured' => 'sometimes|boolean',
    ]);

    $product->update($validated);

    return response()->json($product);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}