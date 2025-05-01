<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductAttributeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $attributes = [
            [
                'product_type_id' => 1,
                'name' => 'bow_length',
                'data_type' => 'number',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'product_type_id' => 1,
                'name' => 'bow_weight',
                'data_type' => 'number',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'product_type_id' => 1,
                'name' => 'orientation',
                'data_type' => 'enum',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'product_type_id' => 2,
                'name' => 'crossbow_draw_weight',
                'data_type' => 'number',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'product_type_id' => 3,
                'name' => 'slingshot_rubber_width',
                'data_type' => 'number',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'product_type_id' => 4,
                'name' => 'arrow_lenght',
                'data_type' => 'number',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
            [
                'product_type_id' => 4,
                'name' => 'arrow_diameter',
                'data_type' => 'number',
                'created_at' => $now,
                'updated_at' => $now,
            ],  
        ];

        DB::table('product_attributes')->insert($attributes);
    }
}
