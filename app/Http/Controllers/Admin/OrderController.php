<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Detaile;

class OrderController extends Controller
{
    

 public function complete_order(Request $request) {
    
   $request->validate([
            'total' => 'required|numeric',
        ]);

    // Start a transaction to ensure data integrity
    \DB::transaction(function () use ($request) {
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $request->total,
        ]);

        // Get cart items for the authenticated user
        $carts = Cart::where('user_id', Auth::id())->get();

        // Loop through cart items to create order details
        foreach ($carts as $cart) {
            Order_Detaile::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'product_id' => $cart->product_id,
                'price' => $cart->product->price,
                'discount' => $cart->product->discount,
                'quantity' => $cart->quantity,
                'total' => $cart->total,
            ]);
        }

        // Optionally, clear the cart after creating the order
        Cart::where('user_id', Auth::id())->delete();
    });

    return redirect()->route('front.mycart')
    ->with('msg', 'Order placed successfully!');

 }

  public function all_orders() {
     $data = Order::latest('id')->paginate(10);
     return view('admin.all_orders', compact('data'));
  } 

  public function show_order($id) {
     $data = Order::findOrFail($id);
     return view('admin.show_order', compact('data'));
  }




}
