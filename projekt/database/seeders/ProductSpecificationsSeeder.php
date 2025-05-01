<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSpecificationsSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $bowSpecs = [
            // Apollo’s Whisper
            [1, 1, 68], [1, 1, 70], [1, 2, 40], [1, 2, 45], [1, 3, 'universal'],
            
            // Artemis' Grace
            [2, 1, 66], [2, 1, 68], [2, 2, 35], [2, 2, 40], [2, 3, 'right'],
            
            // Herculean Draw
            [3, 1, 70], [3, 1, 72], [3, 2, 55], [3, 2, 60], [3, 3, 'left'],
            
            // Zeus’ Thunderstring
            [4, 1, 64], [4, 1, 66], [4, 2, 50], [4, 2, 55], [4, 3, 'universal'],
            
            // Bow of Delphi
            [5, 1, 60], [5, 1, 62], [5, 2, 30], [5, 2, 35], [5, 3, 'right'],
            
            // Eros' Kiss
            [6, 1, 58], [6, 1, 60], [6, 2, 25], [6, 2, 30], [6, 3, 'left'],
            
            // Odysseus’ Curve
            [7, 1, 67], [7, 1, 69], [7, 2, 45], [7, 2, 50], [7, 3, 'right'],
            
            // Theban Phantom
            [8, 1, 65], [8, 1, 67], [8, 2, 38], [8, 2, 42], [8, 3, 'left'],
            
            // Titanfall Recurve
            [9, 1, 72], [9, 1, 74], [9, 2, 60], [9, 2, 65], [9, 3, 'universal'],
            
            // Oracle’s String
            [10, 1, 63], [10, 1, 65], [10, 2, 32], [10, 2, 36], [10, 3, 'right'],
        ];

        $crossbowSpecs = [
            // Apollo's Wrath
            [11, 4, 150], [11, 4, 160],
            
            // Hades Whisper
            [12, 4, 140], [12, 4, 145],
            
            // Artemis Strike
            [13, 4, 155], [13, 4, 165],
            
            // Medusa Gaze
            [14, 4, 135], [14, 4, 140],
            
            // Perseus Shot
            [15, 4, 160], [15, 4, 170],
            
            // Ares Thunderbolt
            [16, 4, 165], [16, 4, 175],
            
            // Hermes Dart
            [17, 4, 130], [17, 4, 135],
            
            // Zeus Boltcaster
            [18, 4, 180], [18, 4, 190],
            
            // Hephaestus Forgebolt
            [19, 4, 145], [19, 4, 155],
            
            // Odysseus Aim
            [20, 4, 150], [20, 4, 160],
        ];

        $slingshotSpecs = [
            // Apollo's Reach
            [21, 5, 1.2], [21, 5, 1.5],
            
            // Athena's Precision
            [22, 5, 1.0], [22, 5, 1.3],
            
            // Hermes Flight
            [23, 5, 0.9], [23, 5, 1.4],
            
            // Zeus Fury
            [24, 5, 1.6], [24, 5, 1.9],
            
            // Artemis Hunt
            [25, 5, 1.1], [25, 5, 1.3],
            
            // Hades Grip
            [26, 5, 1.7], [26, 5, 1.8],
            
            // Poseidon's Wave
            [27, 5, 1.2], [27, 5, 1.6],
            
            // Ares Thunder
            [28, 5, 1.4], [28, 5, 1.8],
            
            // Hephaestus Craft
            [29, 5, 1.5], [29, 5, 1.7],
            
            // Medusa's Vengeance
            [30, 5, 1.3], [30, 5, 1.6],
        ];

        $arrowSpecs = [
            // Apollo's Arrow
            [31, 6, 82], [31, 6, 87], [31, 7, 7.5], [31, 7, 8.2],
        
            // Artemis Feather
            [32, 6, 78], [32, 6, 84], [32, 7, 6.8], [32, 7, 7.9],
        
            // Hades Piercer
            [33, 6, 85], [33, 6, 89], [33, 7, 8.6], [33, 7, 9.0],
        
            // Zeus Lightning Tip
            [34, 6, 80], [34, 6, 88], [34, 7, 7.4], [34, 7, 8.7],
        
            // Ares Warshaft
            [35, 6, 76], [35, 6, 81], [35, 7, 7.1], [35, 7, 8.4],
        
            // Hermes Glide
            [36, 6, 75], [36, 6, 79], [36, 7, 6.3], [36, 7, 6.9],
        
            // Persephone's Thorn
            [37, 6, 77], [37, 6, 85], [47, 7, 7.0], [47, 7, 7.6],
        
            // Athena's Insight
            [38, 6, 81], [38, 6, 86], [38, 7, 6.7], [38, 7, 8.1],
        
            // Medusa's Fang
            [39, 6, 79], [39, 6, 83], [39, 7, 7.3], [39, 7, 8.9],
        
            // Dionysus Flight
            [40, 6, 83], [40, 6, 90], [40, 7, 8.0], [40, 7, 8.8],
        ];
        
        
        $productSpecifications = [];
        
        foreach ($bowSpecs as [$productId, $attributeId, $value]) {
            $productSpecifications[] = [
                'product_id' => $productId,
                'attribute_id' => $attributeId,
                'value' => $value,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach ($crossbowSpecs as [$productId, $attributeId, $value]) {
            $productSpecifications[] = [
                'product_id' => $productId,
                'attribute_id' => $attributeId,
                'value' => $value,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach ($slingshotSpecs as [$productId, $attributeId, $value]) {
            $productSpecifications[] = [
                'product_id' => $productId,
                'attribute_id' => $attributeId,
                'value' => $value,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach ($arrowSpecs as [$productId, $attributeId, $value]) {
            $productSpecifications[] = [
                'product_id' => $productId,
                'attribute_id' => $attributeId,
                'value' => $value,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        
        DB::table('product_specifications')->insert($productSpecifications);
    }
}
