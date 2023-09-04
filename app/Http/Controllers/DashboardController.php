<?php

namespace App\Http\Controllers;

use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleItem;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Sale::getTodayTotal();
        $monthly = Sale::getMonthlyTotal();
        $yearly = Sale::getYearlyTotal();
        $sales = Sale::where('user_id', auth()->id())->latest()->get();

        return view('dashboard', [
            'monthly' => $monthly,
            'yearly' => $yearly,
            'today' => $today,
            'sales' => $sales
        ]);
    }

    public function saleView(Sale $sale)
    {
        $items = SaleItem::where('sale_id', $sale->id)->get();

        return view('sale-view', [
            'items' => $items,
            'total' => $sale->total_amount
        ]);
    }
}
