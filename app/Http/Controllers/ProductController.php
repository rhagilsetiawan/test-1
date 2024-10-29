<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("n");
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'code' => 'required|max:13|unique:products',
            'name' => 'required',
        ]);

        $product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product Created 😍!');
        } else {
            return redirect()->back()->with('error', 'Failed to Create Product 😭!');
        }
    }

    public function edit(string $id)
    {
        return view('products.edit', [
            'product' => Product::find($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'new_code' => 'required|unique:products,id',
            'new_name' => 'required',
        ]);

        // Find the product by the current ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        try {
            // Update the primary key (id)
            $product->id = $request->new_id;
            $product->id = $request->new_name;
            
            // Save the product with the new ID
            $product->save();

        } catch (\Exception $e) {
            // If something goes wrong, catch the error and handle it
            return redirect()->back()->withErrors('Error updating product ID: ' . $e->getMessage());
        }

        $product = Product::find($request->id)->update([
            'name' => $request->name,
        ]);

        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product Updated 😍!');
        } else {
            return redirect()->back()->with('error', 'Failed to Update Product 😭!');
        }
    }

    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Product Destroyed 🤯!');
    }
}
