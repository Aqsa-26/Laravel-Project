<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if(empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }
        return view('frontend.checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'shipping_address' => 'required|string', // Adjust name as per form 'address' -> 'shipping_address' mapping or just use 'address' on frontend
            'phone' => 'required|string',
        ]);

        $cart = session('cart', []);
        if(empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $total = 0;
        foreach($cart as $id => $details) {
            $product = \App\Models\Product::find($id);
            if (!$product) {
                 // Product deleted or invalid
                 unset($cart[$id]);
                 session()->put('cart', $cart);
                 return redirect()->route('cart.index')->with('error', 'One or more items in your cart are no longer available.');
            }

            if ($product->stock < $details['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Sorry, ' . $product->name . ' is out of stock (Available: ' . $product->stock . '). Please update your cart.');
            }

            $total += $details['price'] * $details['quantity'];
        }

        $order = \App\Models\Order::create([
            'user_id' => auth()->id(), // Assuming auth
            'total_price' => $total,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address, // Note: form uses 'address'
            'phone' => $request->phone,
            'payment_method' => 'cod' // Default for now
        ]);

        foreach($cart as $id => $details) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);

            // Decrement Stock
            $product = \App\Models\Product::find($id);
            if($product) {
                $product->stock = $product->stock - $details['quantity'];
                $product->save();
            }
        }

        session()->forget('cart');
        
        return redirect()->route('order.success')->with('order_id', $order->id);
    }
}
