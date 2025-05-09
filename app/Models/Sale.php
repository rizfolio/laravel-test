<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'unit_cost', 'commission', 'shipping_cost', 'selling_price','sold_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
