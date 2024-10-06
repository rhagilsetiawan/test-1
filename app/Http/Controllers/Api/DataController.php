<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Transaction;

class DataController extends Controller
{
    //untuk searching product by location
    public function index($productID)
    {

        try {
            // Query to get the data
            $places = DB::table('transactions')
                ->join('products', 'transactions.prod_id', '=', 'products.id')
                ->join('shops', 'transactions.shop_id', '=', 'shops.id')
                ->select(
                    'transactions.id as id',
                    'products.id as prod_id',
                    'transactions.price as price',
                    'shops.name as shop_name',
                    'shops.lat as lat',
                    'shops.lng as lng'
                )
                ->where('transactions.prod_id', $productID)
                ->get();

            // Periksa apakah hasil query kosong
            if ($places->isEmpty()) {
                return response()->json([
                    'error' => 'No data found for the given Product ID'
                ], 404); // Not Found
            }

            // Return the response in plain to be change into GeoJSON format
            return response()->json($places);

        } catch (\Illuminate\Database\QueryException $e) {
            // Menangani kesalahan query database
            return response()->json([
                'error' => 'Database query error: ' . $e->getMessage()
            ], 500); // Internal Server Error
        } catch (\Exception $e) {
            // Menangani kesalahan umum lainnya
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500); // Internal Server Error
        }
    }
    
    public function productsBig()
    {
        $products = Product::latest()->get();
        return datatables()->of($products)
            ->addColumn('action', 'products.components.button-big')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function productsSmall()
    {
        $products = Product::latest()->get();
        return datatables()->of($products)
            ->addColumn('action', 'products.components.button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }



    public function shopsBig()
    {
        $shops = Shop::all();
        return datatables()->of($shops)
            ->addColumn('action', 'shops.components.button-big')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function shopsSmall()
    {
        $shops = Shop::all();
        return datatables()->of($shops)
            ->addColumn('action', 'shops.components.button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }



    public function transactionsBig()
    {
        $transactions = Transaction::all();
        return datatables()->of($transactions)
            ->addColumn('action', 'shops.components.button-big')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function transactionsSmall()
    {
        $transactions = Transaction::all();
        return datatables()->of($transactions)
            ->addColumn('action', 'shops.components.button-small')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}
