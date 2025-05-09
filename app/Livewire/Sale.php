<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ShippingCost;
use App\Models\Sale as SaleModel;

class Sale extends Component
{

    protected $debug = true;
    public $product_id;
    public $product_name='';
    public $quantity = '';
    public $unit_cost = '';
    public $commission = 0;
    public $shipping_cost = 0;
    public $selling_price = 0;

    public $recentSales;
    public $products;

    public function mount()
    {
        $this->products = Product::all();

        if ($this->products->isNotEmpty()) {
            $this->product_id = $this->products->first()->id;
            $this->product_name = $this->products->first()->name;
            $this->commission = $this->products->first()->commission;
            $this->calculateSellingPrice();
        }

        $this->shipping_cost = ShippingCost::first()?->shipping_cost ?? 0;
        $this->recentSales = SaleModel::latest()->get();

        logger('Mounted: ' . $this->selling_price);

    }

    public function updated($field)
    {
     
        if (in_array($field, [ 'unit_cost', 'quantity'])) {
            $this->calculateSellingPrice();
        }

    }

    public function calculateSellingPrice()
    {
        if (intval($this->quantity) > 0  && floatval($this->unit_cost) > 0) {
            $cost = intval($this->quantity) * floatval($this->unit_cost);
            $base = $cost  / (1 - $this->commission);
            $this->selling_price = round($base + $this->shipping_cost, 2);

             
        } else {
             $this->selling_price = 0;
         }

    }

    public function save()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
        ]);
      //  dd($this);
        SaleModel::create([
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unit_cost' => $this->unit_cost,
            'commission' => $this->commission,
            'shipping_cost' => $this->shipping_cost,
            'selling_price' => $this->selling_price,
            'sold_at' => now(),
        ]);

        $this->reset(['quantity', 'unit_cost']);
        $this->mount(); // Refresh recent sales

        session()->flash('message', 'Sale recorded successfully!');
    }

    public function render()
    {
        

        return view('livewire.sale', [
            'products' => $this->products,
        ])->layout('layouts.app');
    }
}
