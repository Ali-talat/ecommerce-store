<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the databas
     * 
     * e seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(10)->create();
        
    }
}
