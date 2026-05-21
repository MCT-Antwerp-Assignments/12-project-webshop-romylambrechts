<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Order;
use App\Models\OrderLine;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(
            fn($item) => $item['price'] * $item['quantity']
        );

        $order = Order::create([
            'customer_id' => 1, 
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'street' => $request->street,
            'nr' => $request->nr,
            'box' => $request->box,
            'zip' => $request->zip,
            'city' => $request->city,
            'country' => $request->country,
            'paid' => 0,
            'total_price' => $total
        ]);

        foreach ($cart as $item) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'product_description' => $item['description'] ?? null,
            ]);
        }
        return redirect()->route('cart'); 
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