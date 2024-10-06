<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prod_id','shop_id','price','user_id'];

    protected $table = 'transactions';

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id'); // Ensure this matches your foreign key
    }

    // Define the relationship with the Shop model
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id'); // Ensure this matches your foreign key
    }
}
