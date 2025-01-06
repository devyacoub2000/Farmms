<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartControlle extends Controller
{
    
    public function store_cart(Request $request, $id) {
     
         $product = Product::findOrFail($id);

         if(!$product || $product->quantity < $request->quantity) {
               return redirect()->route('front.single_product', $id)
               ->with('msg', 'Product not Available in desired quantity.')
               ->with('type', 'danger');
        }

         // Check if The Products is already in the cart for the user 
         
        $cartItem = Cart::where('user_id', Auth::id())
        ->where('product_id', $id)
        ->first();

        if($cartItem) {
            // update the existing cart item (increase quantity)
            $cartItem->quantity += $request->quantity;
            if($cartItem->discount > 0) {
                 $cartItem->total = $cartItem->quantity * $cartItem->discount;
            } else {
                 $cartItem->total = $cartItem->quantity * $cartItem->price;
            }
            $cartItem->save();
        } else {
            // Add new product to cart 
            if($product->discount > 0) {
                $total = $request->quantity * $product->discount;
            }else {
                $total = $request->quantity * $product->price;
            }
            Cart::create([
               'user_id' => auth()->user()->id,
               'product_id' => $product->id,
               'price' =>  $product->price,
               'discount' => $product->discount,
               'quantity' => $request->quantity,
               'total' => $total,
            ]);
        }

        // Decrease quantity Product 

        $product->quantity -= $request->quantity;
        $product->save();

         return redirect()->route('front.single_product', $id)
         ->with('msg', 'Add Product To Your Cart Successfully');
    }

    public function mycart() {
        $data = Cart::where('user_id', Auth::id())->latest('id')->paginate(10);
        return view('front.mycart', compact('data'));
    }
    public function remove_cart($id) {
        $item = Cart::findOrFail($id);
        $item->delete();
        return redirect()->route('front.mycart')
        ->with('msg', 'Remove Product Cart Successfully');
    }


}
