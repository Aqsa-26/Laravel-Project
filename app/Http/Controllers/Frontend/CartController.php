<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('frontend.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $id = $request->product_id;
        $quantity = $request->quantity ?? 1;
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);
        
        $currentQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $newQty = $currentQty + $quantity;

        if ($product->stock < $newQty) {
            return redirect()->back()->with('error', 'Sorry, we only have ' . $product->stock . ' items in stock.');
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $newQty;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        return redirect()->back();
    }
}
