<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductToCategorySeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
