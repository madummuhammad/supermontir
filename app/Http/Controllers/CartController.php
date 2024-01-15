<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Garage;
use App\Models\Kupon;
use App\Models\UserKupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $garage = Garage::where('user_id', auth()->user()->id)->get();
        $kupon = UserKupon::where('status', 'unused')->where('user_id', auth()->user()->id)->with('kupon')->get();
        foreach ($kupon as $key => $value) {
            if ($value->kupon->expired_at && Carbon::now()->gt($value->kupon->expired_at)) {
                if ($value->status == 'unused') {
                    $value->update(['status' => 'expired']);
                }
            }
        }
        $kupon = UserKupon::where('status', 'unused')->where('user_id', auth()->user()->id)->with('kupon')->get();

        return Inertia::render('Cart/Index', [
            'garage' => $garage,
            'kupon' => $kupon,
        ]);
    }

    public function store(Request $request)
    {
        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->id,
            'price' => $request->price,
            'qty' => $request->qty,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Berhasil ditambahkan ke keranjang']);
    }

    public function get()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->with('product')->get();

        return response()->json(['status' => 'success', 'data' => $cart]);
    }

    public function destroy(Request $request)
    {
        $cartItems = $request->json()->all();

        foreach ($cartItems as $cartItem) {
            Cart::where('id', $cartItem['id'])->delete();
        }

        return response()->json(['status' => 'success', 'message' => 'Keranjang berhasil dihapus']);
    }
}
