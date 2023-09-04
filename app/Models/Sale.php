<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount'
    ];


    // relationships
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    // local scopes
    public function scopeGetTodayTotal(Builder $query)
    {
        return $query->where('user_id', auth()->id())
        ->whereDate('created_at', Carbon::today())
        ->sum('total_amount');
    }

    public function scopeGetMonthlyTotal(Builder $query)
    {
        return $query->where('user_id', auth()->id())
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('total_amount');
    }

    public function scopeGetYearlyTotal(Builder $query)
    {
        return $query->where('user_id', auth()->id())
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('total_amount');
    }
}
