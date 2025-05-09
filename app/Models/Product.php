<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unit_cost', 'commission'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}
