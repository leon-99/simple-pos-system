<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }
}
