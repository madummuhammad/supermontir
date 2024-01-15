<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;

class TransactionController extends Controller
{
    public function index()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        $apiInstance = new InvoiceApi();

        try {
            $payment = OrderPayment::where('user_id', auth()->user()->id)->where('status', 'unpaid')->get();
            foreach ($payment as $key => $value) {
                if($value->xendit_order_id!==null){
                    $result = $apiInstance->getInvoiceById($value->xendit_order_id);
                    if ($result['status'] == 'PAID' or $result['status'] == 'SETTLED') {
                        OrderPayment::where('id', $value->id)->update([
                            'status' => 'paid',
                        ]);
                    }
                }
            }
        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling InvoiceApi->getInvoices: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }

        return Inertia::render('Transaction/Index');
    }

    public function list(Request $request)
    {
        $status = $request->status;

        $order = Order::where('status', $status)->with('item_order.product', 'garage', 'order_payment')->get();

        return response()->json(['status' => 'success', 'data' => $order]);
    }

    public function get_invoice(Request $request)
    {

        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        $apiInstance = new InvoiceApi();
        $invoice_id = $request->xendit_order_id;

        try {
            $result = $apiInstance->getInvoiceById($invoice_id);
            // print_r($result);
            return response()->json(['status' => 'success', 'data' => $result]);
        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling InvoiceApi->getInvoiceById: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }

    }

    public function store(Request $request)
    {

    }
}