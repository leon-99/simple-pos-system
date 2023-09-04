<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CurrentSale;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;

class MakeSaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $total = 0;

        $currentSaleItems = CurrentSale::all();

        // set total
        foreach($currentSaleItems as $currentSaleItem) {
            $total =+ ($currentSaleItem->product->price * $currentSaleItem->quantity) + $total;
        }

        if($total <= 0) {
            return back()->with('failed', 'Can not make sale without any items');
        }

        // update sale
        $sale = new Sale;

        $sale->user_id = auth()->id();
        $sale->total_amount = $total;
        $sale->save();

        // get all current sale items



        foreach($currentSaleItems as $currentSaleItem) {

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $currentSaleItem->product_id,
                'quantity' => $currentSaleItem->quantity
            ]);
        }

        // set sale
        $sale->total_amount = $total;
        $sale->save();

        // remove all items from current sale table
        CurrentSale::truncate();

        $retrunItems = SaleItem::where('sale_id', $sale->id)->get();
        $time = Carbon::now()->toDateTimeString();

        return view('invoice', [
            "items" => $retrunItems,
            "total" => $sale->total_amount,
            'time' => $time
        ]);
    }
}
