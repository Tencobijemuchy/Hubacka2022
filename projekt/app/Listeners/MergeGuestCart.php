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

        foreach ($guestCart as $compositeKey => $guestItem) {
            $productId = explode('-', $compositeKey)[0];

            $customizations = $guestItem['customizations'] ?? null;
            $customizations = empty($customizations) ? null : $customizations;


            $existing = DB::table('user_items')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('customizations', json_encode($customizations))
                ->first();

            if ($existing) {
                DB::table('user_items')
                    ->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->where('customizations', json_encode($customizations))
                    ->update([
                        'quantity' => $existing->quantity + $guestItem['quantity'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('user_items')->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $guestItem['quantity'],
                    'customizations' => json_encode($customizations),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Session::forget('cart');
    }

}

