<?php

namespace App\Http\Controllers;

use App\Models\ShippingCost;
use Illuminate\Http\Request;

class ShippingCostController extends Controller
{
    // Display the shipping cost management page
    public function index()
    {
        $shippingCost = ShippingCost::first();
       
        return view('shipping_partners', compact('shippingCost'));
    }

    // Save the shipping cost
    public function update(Request $request)
    {
        // Validate the shipping cost input
        $request->validate([
            'shipping_cost' => 'required|numeric|min:0',
        ]);

        // If a shipping cost exists, update it, otherwise create a new one
        $shippingCost = ShippingCost::first();
        if ($shippingCost) {
            $shippingCost->shipping_cost = $request->shipping_cost;
            $shippingCost->save();
        } else {
            ShippingCost::create(['shipping_cost' => $request->shipping_cost]);
        }

        return redirect()->route('shipping-cost.index')->with('message', 'Shipping cost updated successfully!');
    }
}
