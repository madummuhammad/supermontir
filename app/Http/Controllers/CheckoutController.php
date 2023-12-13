<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ItemOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'wa' => 'required|numeric',
            'garage_id' => 'required',
        ]);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'wa' => $validatedData['wa'],
            'garage_id' => $validatedData['garage_id'],
            'status' => 'baru',
            'total' => $request->total,
        ]);

        foreach ($request->items as $key => $value) {
            ItemOrder::create([
                'user_id' => auth()->user()->id,
                'cart_id' => $value['id'],
                'product_id' => $value['product_id'],
                'order_id' => $order->id,
            ]);

            Cart::where('id', $value['id'])->delete();
        }

        return back()->with('message', ['status' => 'success', 'message' => 'Success! Data berhasil di tambah']);
    }
}
