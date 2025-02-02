<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all(); // Retrieve all products
        return response()->json([
          'status' => 'success',
          'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1️⃣ Validate Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
        ]);

        // 2️⃣ Create and Save the Product
        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
        ]);

        // 3️⃣ Return Response
        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      // 1️⃣ Validate Input Data
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|integer',
        ]);

        // 2️⃣ Find the Product (or return 404 if not found)
        $product = Product::findOrFail($id);

        // 3️⃣ Update the Product
        $product->update($validated);

        // 4️⃣ Return Response
        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ], 200);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
      // delete product by id
      // 1️⃣ Find the product by ID (or fail if not found)
        $product = Product::findOrFail($id);

        // 2️⃣ Delete the product
        $product->delete();

        // 3️⃣ Return a success response
        return response()->json([
            'message' => 'Product deleted successfully!'
        ], 200);
    }
}
