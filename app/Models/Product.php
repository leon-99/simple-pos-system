<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;


    // lolac scopes
    public function scopeGetProductsInStock(Builder $query)
    {
        return $query->where('quantity_on_hand', '>', 0);
    }
}
