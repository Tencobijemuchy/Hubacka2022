<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MergeGuestCart
{
    public function handle(Authenticated $event)
    {
        $userId = $event->user->id;
        $guestCart = session('cart', []);

        foreach ($guestCart as $productId => $guestItem) {
            $existing = DB::table('user_items')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existing) {
                DB::table('user_items')
                    ->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->update([
                        'quantity' => $existing->quantity + $guestItem['quantity'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('user_items')->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $guestItem['quantity'],
                    'customizations' => json_encode($guestItem['customizations'] ?? null),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Session::forget('cart');
    }
}

