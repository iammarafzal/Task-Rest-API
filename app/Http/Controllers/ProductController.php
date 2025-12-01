<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;  //  imports the Request class from the Illuminate\Http namespace

use Illuminate\Support\Facades\Validator; //imports the Validator facade, which provides a simple interface for validating data in Laravel.

use App\Models\Product;  // imports the Product model from the App\Models namespace.


class ProductController extends Controller
{
    //Method for showing product page
    public function index()
    {
        $products = Product::all();
        return view('product.list', compact('products'));
    }

    //Method for creating product
    public function create()
    {
        return view('product.create');
    }

    // Method for storing product in DB
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Create a new product instance and assign validated fields directly
        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'] ?? null;  // Avoid potential undefined index error
    
        // Handle the image upload (if exists)
        if ($request->hasFile('image')) {
            // Save the image in the 'public/images' directory
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }
    
        // Save the product to the database
        $product->save();
    
        // Redirect with success message
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    //Method for editing product
    public function edit($id)
    {   
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }
    
 // Handle the form submission and update the product
    public function update($id, Request $request)
    {
        $product = Product::find($id);

        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'; 
        }


        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // Handle the image upload (if a new image is uploaded)
    if ($request->hasFile('image')) {
        // Delete the old image (if it exists)
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));  // Delete old image file
        }

        // Save the new image in the 'public/images' directory
        $imagePath = $request->file('image')->store('images', 'public');
        $product->image = $imagePath; // Update the product's image path
    }

    // Save the updated product to the database
    $product->save();
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
        
    }

    //Method for deleting product
    public function destroy($id)
    {
        // Find the product by ID or fail with 404 if not found
        $product = Product::findOrFail($id);
    
        // Delete the old image (if it exists)
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));  // Delete old image file
        }
    
        // Delete the product from the database
        $product->delete();
    
        // Redirect back with success message
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
    
}
