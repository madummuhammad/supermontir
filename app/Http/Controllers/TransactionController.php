<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        return Inertia::render('Transaction/Index');
    }

    public function list(Request $request)
    {
        $status = $request->status;

        $order = Order::where('status', $status)->with('item_order.product', 'garage')->get();

        return response()->json(['status' => 'success', 'data' => $order]);
    }

    public function store(Request $request)
    {

    }
}
