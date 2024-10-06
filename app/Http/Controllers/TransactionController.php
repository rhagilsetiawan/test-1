<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

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
        return redirect()->route('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'prod_id' => 'required',
            'shop_id' => 'required',
            'price' => 'required',
        ]);

        // Update jika data ada, Create jika tidak ada
        $transaction = Transaction::updateOrCreate(
            ['prod_id' => $request->prod_id, 'shop_id' => $request->shop_id],
            ['price' => $request->price, 'user_id' => $user->id]);
        
        if ($transaction) {
            return redirect()->route('transactions.index')->with('success', 'Transaction Created 😍!');
        } else {
            return redirect()->route('transactions.index')->with('error', 'Transaction Failed 😭!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // tidak dipakai
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // tidak dipakai, langsung dari create
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // tidak dipakai
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Transaction::destroy($id)) {
            return redirect()->route('transactions.index')->with('success', 'Transaction Destroyed 🤯!');
        } else {
            return redirect()->route('transactions.index')->with('error', 'Transaction Failed to Destroy 😭!');
        }
        ;
    }
}
