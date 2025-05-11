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
        $customizations = empty($customizations) ? null : $customizations;

        if (auth()->check()) {
            $userId = auth()->id();

            $existingItem = DB::table('user_items')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('customizations', json_encode($customizations))
                ->first();

            if ($existingItem) {
                DB::table('user_items')
                    ->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->where('customizations', json_encode($customizations))
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

            $customKey = $productId . '-' . md5(json_encode($customizations));

            if (isset($cart[$customKey])) {
                $cart[$customKey]['quantity'] += $quantity;
            } else {
                $cart[$customKey] = [
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

    public function destroy(Request $request, $id)
    {
        $encodedCustomizations = $request->input('customizations');
        $decodedCustomizations = json_decode(base64_decode($encodedCustomizations), true);
        $normalizedCustomizations = empty($decodedCustomizations) ? null : json_encode($decodedCustomizations);

        if (auth()->check()) {
            DB::table('user_items')
                ->where('user_id', auth()->id())
                ->where('product_id', $id)
                ->where(function ($query) use ($normalizedCustomizations) {
                    if (is_null($normalizedCustomizations)) {
                        $query->whereNull('customizations');
                    } else {
                        $query->where('customizations', $normalizedCustomizations);
                    }
                })
                ->delete();
        } else {
            $cart = session()->get('cart', []);

            foreach ($cart as $key => $item) {
                $itemCustoms = $item['customizations'] ?? null;

                if (
                    $item['id'] == $id &&
                    (
                        (empty($itemCustoms) && empty($decodedCustomizations)) ||
                        json_encode($itemCustoms) === json_encode($decodedCustomizations)
                    )
                ) {
                    unset($cart[$key]);
                    break;
                }
            }

            session()->put('cart', $cart);
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
