<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_category = ["Pro", "Advance", "Daily"];
        $jml = count($arr_category);
        for ($i = 0; $i < $jml; $i++) {
            Category::create([
                'category_identifier' => $arr_category[$i],
                'category_active_status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
