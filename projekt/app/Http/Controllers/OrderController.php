<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function showOrderForm()
    {
        if (auth()->check()) {
            $cartItems = DB::table('user_items')
                ->leftJoin('products', 'user_items.product_id', '=', 'products.id')
                ->where('user_items.user_id', auth()->id())
                ->get();
        } else {
            $cartItems = collect(session('cart', []));
        }

        return view('order_details', compact('cartItems'));
    }


    public function placeOrder(Request $request)
    {
        $user = Auth::user();
    
        $cart = Auth::check() 
            ? DB::table('user_items')
            ->leftJoin('products', 'user_items.product_id', '=', 'products.id')
            ->where('user_items.user_id', auth()->id())
            ->get()
            : session('cart', []);
    
        if (empty($cart) || count($cart) === 0) {
            return redirect()->back()->withErrors(['Cart is empty.'])->with('error', true);
        }
    
        $total = 0;
        foreach ($cart as $item) {
            $price = is_array($item) ? $item['price'] : $item->price;
            $quantity = is_array($item) ? $item['quantity'] : $item->quantity;
            $total += $price * $quantity;
        }
    
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => Auth::check() ? Auth::id() : null,
            'total_price' => $total,
            'order_date' => Carbon::now()->toDateString(),
            'shipment_method' => $request->input('delivery'),
            'payment_method' => $request->input('payment'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),   
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        foreach ($cart as $item) {
            $productId = is_array($item) ? $item['id'] : $item->product_id;
            $quantity = is_array($item) ? $item['quantity'] : $item->quantity;
            $customizations = is_array($item) ? $item['customizations'] : $item->customizations;
            $price = is_array($item) ? $item['price'] : $item->price;
    
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'customizations' => json_encode($customizations),
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        if ($user) {
            DB::table('user_items')->where('user_id', $user->id)->delete();
        } else {
            session()->forget('cart');
        }
    
        return redirect()->route('index')->with('success', 'Order placed successfully!');
    }
}