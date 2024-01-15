<?php

namespace App\Http\Controllers;

    use App\Models\Cart;
use App\Models\ItemOrder;
use App\Models\Kupon;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

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

        $kupon_id = null;
        if ($request->kupon !== null) {
            $kupon = Kupon::where('code', $request->kupon)->where('user_id', auth()->user()->id)->first();
            if ($kupon) {
                $kupon_id = $kupon->id;
                UserKupon::where('kupon_id', $kupon->id)->where('user_id', auth()->user()->id)->update([
                    'status' => 'used',
                ]);

                // $request->total = $request->total - $kupon->discount;
            }
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'wa' => $validatedData['wa'],
            'garage_id' => $validatedData['garage_id'],
            'kupon_id' => $kupon_id,
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

        $payment = OrderPayment::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'xendit_order_id' => null,
            'total' => $request->total,
        ]);

        $items = ItemOrder::where('order_id', $order->id)->get();
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        if (env('APP_ENV') == 'production') {
            $url_redirect = 'https://supermontir.id';
        } elseif (env('APP_ENV') == 'development') {
            // $url_redirect = 'https: //dev.supermontir.id';
            $url_redirect = 'http://localhost:8100';
        }
        $apiInstance = new InvoiceApi();
        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => $payment->id,
            'description' => 'Invoice ' . $payment->id . ' untuk nomor pemesanan ORD' . $order->id,
            'amount' => $request->total,
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            'reminder_time' => 1,
        ]);

        $createInvoice = $apiInstance->createInvoice($create_invoice_request);
        OrderPayment::where('id', $payment->id)->update(['xendit_order_id' => $createInvoice['id']]);
        return back()->with('message', ['status' => 'success', 'message' => 'Success! Data berhasil di tambah']);
    }
}
