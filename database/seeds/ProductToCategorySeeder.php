<?php

use Illuminate\Database\Seeder;
use App\ProductToCategory;

class ProductToCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            ProductToCategory::create([
                'ptc_product_id' => $i + 1,
                'ptc_category_id' => $i != 3 ? $i + 1 : 3,
            ]);  
        }
    }
}
