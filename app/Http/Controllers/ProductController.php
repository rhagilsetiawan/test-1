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
        $this->validate($request, [
            'id' => 'required|max:13|min:13|unique:products',
            'name' => 'required',
            'category' => 'required',
        ]);

        $product = Product::create([
            'id' => $request->id,
            'name' => $request->name,
            'category' => $request->category,
        ]);

        if($product) {
            return redirect()->route('products.index')->with('success', 'Product Created 😍!');
        } else {
            return redirect()->route('products.index')->with('error', 'Failed to Create Product 😭!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dibiarkan saja supaya tidak terjadi error pada Route::resource
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
            'id' => 'required|max:13|min:13',
            'name' => 'required',
            'category' => 'required',
        ]);

        $product = Product::find($id)->update([
            'id' => $request->id,
            'name' => $request->name,
            'category' => $request->category
        ]);

        if($product) {
            return redirect()->route('products.index')->with('success', 'Product Updated 😍!');
        } else {
            return redirect()->route('products.index')->with('error', 'Failed to Update Product 😭!');
        }
    }

    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Product Destroyed 🤯!');
    }
}
