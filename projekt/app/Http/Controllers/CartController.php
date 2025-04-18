<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserItem;

class CartController extends Controller {


    public function addToCart(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity'); 
    
        $existingItem = DB::table('user_items')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    
        if ($existingItem) {
            DB::table('user_items')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->update([
                    'quantity' => $existingItem->quantity + $quantity,
                    'updated_at' => now(),
                ]);
        } else {
                DB::table('user_items')->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'customizations' => json_encode($request->input('customizations')),
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return redirect()->back()->with('success', 'Product added to cart.');
    }
    

    public function showCart()
    {
        $userId = auth()->id();

        $items = DB::table('user_items')
            ->leftJoin('products', 'user_items.product_id', '=', 'products.id')
            ->where('user_items.user_id', $userId)
            ->get();

        $totalPrice = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('shoppingCart', compact('items', 'totalPrice'));
    }

    public function destroy($id)
    {
        DB::table('user_items')
            ->where('user_id', auth()->id())
            ->where('product_id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');

    }

}
