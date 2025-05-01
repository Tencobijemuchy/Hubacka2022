<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManufacturersSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $manufacturers = [
            [
                'name' => 'EK Archery',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'name' => 'Ragim',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'name' => 'Lazecky',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'name' => 'White Feather',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'name' => 'Black Hawk',
                'created_at' => $now,
                'updated_at' => $now,
            ],  

        ];

        DB::table('manufacturers')->insert($manufacturers);
    }
}
