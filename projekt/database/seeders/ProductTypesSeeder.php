<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductTypesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $types = [
            [
                'type_name' => 'Bow',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'type_name' => 'Crossbow',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'type_name' => 'Sling',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'type_name' => 'Arrow',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'type_name' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],  

        ];

        DB::table('product_types')->insert($types);
    }
}
