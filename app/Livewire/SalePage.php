<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\CurrentSale;

use Livewire\WithPagination;


class SalePage extends Component
{
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public $sort = 'quantity_on_hand';



    public function changeSort()
    {
        $this->render();
    }

    public function addItem($id)
    {
        $item = Product::find($id);

        if ($item->quantity_on_hand > 0) {
            if (CurrentSale::where('name', $item->name)->count() > 0) {
                $currentItem = CurrentSale::where('name', $item->name)->first();
                $currentItem->quantity = $currentItem->quantity += 1;
                $currentItem->save();

                $item->quantity_on_hand = $item->quantity_on_hand - 1;
                $item->save();
            } else {
                CurrentSale::create([
                    'product_id' => $id,
                    'name' => $item->name,
                    'quantity' => 1
                ]);

                $item->quantity_on_hand = $item->quantity_on_hand - 1;
                $item->save();
            }
        }


    }

    public function removeItem($id)
    {
        $item = Product::find($id);

        if (CurrentSale::where('name', $item->name)->first()->quantity > 1) {
            $currentItem = CurrentSale::where('name', $item->name)->first();
            $currentItem->quantity = $currentItem->quantity -= 1;
            $currentItem->save();

            $item->quantity_on_hand = $item->quantity_on_hand + 1;
            $item->save();
        } else {
            $currentItem = CurrentSale::where('name', $item->name)->first();
            $currentItem->delete();

            $item->quantity_on_hand = $item->quantity_on_hand + 1;
            $item->save();
        }
    }

    public function clear()
    {

        $currentSales = CurrentSale::all();

        foreach($currentSales as $i) {
            $item = Product::where('id', $i->product_id)->first();
            $item->quantity_on_hand = $item->quantity_on_hand + $i->quantity;
            $item->save();
        }

        CurrentSale::truncate();
    }

    public function render()
    {
        $products = Product::orderByDesc($this->sort)->paginate(10);
        $CurrentProducts = CurrentSale::all();
        $total = 0;
        foreach ($CurrentProducts as $i) {
            $total = +($i->product->price * $i->quantity) + $total;
        }

        return view('livewire.salePage', [
            "products" => $products,
            'CurrentProducts' => $CurrentProducts,
            'total' => $total
        ]);
    }
}
