<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_product = ["majoo Pro", "majoo Advance", "majoo Lifestyle", "majoo Desktop"];
        $arr_image_name = ["standard_repo.png", "paket-advance.png", "paket-lifestyle.png", "paket-desktop.png"];
        $jml = count($arr_product);
        for ($i = 0; $i < $jml; $i++) {
            Product::create([
                'product_identifier' => $arr_product[$i],
                'product_desc' => "Lorem Ipsum typesetting industry. Lorem Ipsum product " . $arr_product[$i] . " example",
                'product_price' => 2750000,
                'product_stock' => rand(1, 100),
                'product_image_name' => $arr_image_name[$i],
                'created_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
