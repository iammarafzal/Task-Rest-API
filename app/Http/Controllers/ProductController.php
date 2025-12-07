<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'true',
            'message' => 'Products retrieved successfully',
            'data' => $products
        ], 200);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            // Save the image in the 'public/images' directory
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = asset('storage/' . $imagePath); // Store the image path
        }
        $product->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Product created successfully',
            'data' => $product
        ], 201
        );
    }

    // GET /api/products/{id}
    public function show($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'false',
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'status' => 'true',
            'message' => 'Product retrieved successfully',
            'data' => $product
        ], 200);
    }

    // PUT /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'false',
                'message' => 'Product not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')){
            // Delete old image if exists
            if ($product->image){
                // Extract relative path from URL to delete file
                $relativePath = str_replace(asset('storage/'), '', $product->image);
                if (Storage::disk('public')->exists($relativePath)){
                    Storage::disk('public')->delete($relativePath);
                }
            }
            $path = $request->file('image')->store('images', 'public');
            $product->image = asset('storage/' . $path);
        }
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    // DELETE /api/products/{id}
    public function destroy($id){
        $product = Product::find($id);

        if (!$product){
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        if ($product->image){
            $relativePath = str_replace(asset('storage/'), '', $product->image);
            if (Storage::disk('public')->exists($relativePath)){
                Storage::disk('public')->delete($relativePath);
            }
        }
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    }
}