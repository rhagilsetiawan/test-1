<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $shops = Shop::all();
        return view('transactions.create', ['products' => $products, 'shops' => $shops]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'prod_id' => 'required|numeric',
            'shop_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update if the record exists, create if it doesn't
        $transaction = Transaction::updateOrCreate(
            ['prod_id' => $request->prod_id, 'shop_id' => $request->shop_id],
            ['price' => $request->price, 'user_id' => $user->id]
        );

        if ($transaction) {
            return redirect()->route('transactions.index')->with('success', 'Transaction Created 😍!');
        } else {
            return redirect()->back()->with('error', 'Creation Failed 😭!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('transactions.index')->with('success', 'Transaction Destroyed 🤯!');
    }
}
