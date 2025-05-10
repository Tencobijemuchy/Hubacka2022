<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@lukeshop.sk',
                'password' => Hash::make('admin'),
                'is_admin' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'rene',
                'email' => 'rene@lukeshop.sk',
                'password' => Hash::make('rene'),
                'is_admin' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'Tencobijemuchy',
                'email' => 'tencobijemuchy@lukeshop.sk',
                'password' => Hash::make('rene'),
                'is_admin' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        DB::table('users')->insert($users);
    }
}
