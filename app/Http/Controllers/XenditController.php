<?php

namespace App\Http\Controllers;

use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{

    // public function __construct()
    // {
    //     $xendit_key = 'xnd_public_development_lxbS_sIoNBRuoxsegJnaDgSxkcZpNocXRsBGHXuLYUpefz2BIb56XISMdiuUN6jT';
    //     Xendit::setApiKey($store->xendit_key . ':');
    // }

    public function create_invoice($payment_id, $name, $email, $phone, $total, $items, $order)
    {
        Xendit::setApiKey($store->xendit_key . ':');
        if (env('APP_ENV') == 'production') {
            $url_redirect = 'https://supermontir.id';
        } elseif (env('APP_ENV') == 'development') {
            // $url_redirect = 'https: //dev.supermontir.id';
            $url_redirect = 'http://localhost:8100';
        }
        return $params = [
            'external_id' => $payment_id,
            'amount' => $total,
            'description' => 'Invoice ' . $payment_id . ' untuk nomor pemesanan ORD' . $order->id,
            'invoice_duration' => 86400,
            'customer' => [
                'given_names' => $name,
                'surname' => $name,
                'email' => $email,
            ],
            'customer_notification_preference' => [
                'invoice_created' => [
                    'email',
                ],
                'invoice_reminder' => [
                    'email',
                ],
                'invoice_paid' => [
                    'email',
                ],
                'invoice_expired' => [
                    'email',
                ],
            ],
            'success_redirect_url' => $url_redirect . '/order/order-detail/' . $order->id,
            'failure_redirect_url' => $url_redirect . '/order/order-detail/' . $order->id,
            'currency' => 'IDR',
            'items' => $items,
        ];
        return $createInvoice = \Xendit\Invoice::create($params);
        OrderPayment::where('id', $payment_id)->update(['xendit_order_id' => $createInvoice['id']]);
    }

    public function getInvoice()
    {
        $id = request('order_payment_id');
        $invoice_id = OrderPayment::where('id', $id)->first()->xendit_order_id;
        $getInvoice = \Xendit\Invoice::retrieve($invoice_id);
        return response()->json($getInvoice);
    }
}
