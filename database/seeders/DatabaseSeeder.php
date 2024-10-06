<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Product::create([
            'id' => 1,
            'code' => '1234567890123',
            'name' => 'New Orleans ml',
        ]);

        \App\Models\Product::create([
            'id' => 2,
            'code' => '1234567890124',
            'name' => 'Aqua 100ml',
        ]);

        \App\Models\Product::create([
            'id' => 3,
            'code' => '2234567890121',
            'name' => 'Kit kat',
        ]);


        \App\Models\Shop::create([
            'id' => 1,
            'name' => 'toko1',
            'address' => 'Jl.Soekarno',
            'lat' => -0.04183445144272559,
            'lng' => 109.32028965224141,
        ]);

        \App\Models\Shop::create([
            'id' => 2,
            'name' => 'toko2',
            'address' => 'Jl.Soetoyo',
            'lat' => -0.04520722723041784,
            'lng' => 109.36358881291396,
        ]);

        \App\Models\Shop::create([
            'id' => 3,
            'name' => 'toko2',
            'address' => 'Jl.Soetoyo',
            'lat' => -0.05623711446160067,
            'lng' => 109.3372446919995,
        ]);

        \App\Models\User::create([
            'id' => 1,
            'name' => 'Budi Ari',
            'email' => 'a@a.a',
            'password' => "123456",
        ]);

        \App\Models\Transaction::create([
            'prod_id' => 1,
            'shop_id' => 1,
            'price' => 3000,
            'user_id' => 1
        ]);

        \App\Models\Transaction::create([
            'prod_id' => 1,
            'shop_id' => 2,
            'price' => 2000,
            'user_id' => 1
        ]);

        \App\Models\Transaction::create([
            'prod_id' => 2,
            'shop_id' => 2,
            'price' => 2000,
            'user_id' => 1
        ]);
    }
}
