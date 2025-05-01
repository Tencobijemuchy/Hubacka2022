<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ProductTypesSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(ManufacturersSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductSpecificationsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
