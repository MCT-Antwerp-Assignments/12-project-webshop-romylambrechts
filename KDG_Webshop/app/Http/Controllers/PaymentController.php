<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use App\Models\Order;
use App\Models\Customer;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(
            fn($item) =>
            $item['price'] * $item['quantity']
        );

        $customer = Customer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'street' => $request->street,
            'nr' => $request->nr,
            'zip' => $request->zip,
            'box' => $request->box,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
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
        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));

        $paymentId = $request->input('id');
        $payment = $mollie->payments->get($paymentId);

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
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_KEY'));

        $payment = $mollie->payments->get($order->mollie_id);

        if ($payment->isPaid()) {
            $order->update(['paid' => 1]);
            session()->forget('cart');
            return view('payment.success');
        }
        return view('payment.failed');
    }
}