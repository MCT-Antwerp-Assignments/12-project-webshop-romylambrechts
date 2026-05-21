<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use App\Models\Order;


class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(
            fn($item) =>
            $item['price'] * $item['quantity']
        );

        $order = Order::create([
            'customer_id' => 1,
            'paid' => 0,
            'total_price' => $total
        ]);

        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($total, 2, '.', '')
            ],
            "description" => "Order #{$order->id}",
            "redirectUrl" => route('payment.return', $order->id),
            "webhookUrl" => "https://retail-lark-sprung.ngrok-free.dev/payment/webhook",
            "metadata" => [
                "order_id" => $order->id,
            ],
        ]);

        $order->update([
            'mollie_id' => $payment->id
        ]);

        return redirect($payment->getCheckoutUrl());
    }
    public function webhook(Request $request)
    {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments()->get($paymentId);
        $order = Order::where('mollie_id', $paymentId)->first();

        if ($order) {
            $order->paid = $payment->isPaid() ? 1 : 0;
            $order->save();
        }
        return response()->json(['status' => 'ok']);
    }

    public function return($orderId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->paid) {
            session()->forget('cart');
            return view('payment.success');
        }
        return view('payment.failed');
    }
}