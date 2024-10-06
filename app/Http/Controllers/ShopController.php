<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shops.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $shop = Shop::create([
            'name' => $request->name,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,

        ]);

        if($shop) {
            return redirect()->route('shops.index')->with('success', 'Shop Created 😍!');
        } else {
            return redirect()->route('shops.index')->with('success', 'Failed to Create Shop 😭!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('shops.edit', [
            'shop' => Shop::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $shop = Shop::find($id)->update([
            'id' => $request->id,
            'name' => $request->name,
            'category' => $request->category
        ]);

        if($shop) {
            return redirect()->route('shops.index')->with('success', 'Shop Updated 😍!');
        } else {
            return redirect()->route('shops.index')->with('error', 'Failed to Update Shop 😭!');
        }
    }

    public function destroy(string $id)
    {
        Shop::destroy($id);
        return redirect()->route('shops.index')->with('success', 'Shop Destroyed 🤯!');
    }
}
