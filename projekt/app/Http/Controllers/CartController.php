<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity'); 
        $customizations = $request->input('customizations');

        if (auth()->check()) {
            $userId = auth()->id();

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
                    'customizations' => json_encode($customizations),
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            $product = DB::table('products')->where('id', $productId)->first();

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'img1' => $product->img1,
                    'description' => $product->description,
                    'customizations' => $customizations,
                    'quantity' => $quantity,
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }
    public function showCart()
    {
        if (auth()->check()) {
            $items = DB::table('user_items')
                ->leftJoin('products', 'user_items.product_id', '=', 'products.id')
                ->where('user_items.user_id', auth()->id())
                ->get();

            $totalPrice = $items->sum(fn($item) => $item->price * $item->quantity);
        } else {
            $items = collect(session('cart', []));
            $totalPrice = $items->sum(fn($item) => $item['price'] * $item['quantity']);
        }

        return view('shoppingCart', compact('items', 'totalPrice'));
    }

    public function destroy($id)
    {
        if (auth()->check()) {
            DB::table('user_items')
                ->where('user_id', auth()->id())
                ->where('product_id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        if (auth()->check()) {
            DB::table('user_items')
                ->where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->update([
                    'quantity' => $quantity,
                    'updated_at' => now()
                ]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }


}
