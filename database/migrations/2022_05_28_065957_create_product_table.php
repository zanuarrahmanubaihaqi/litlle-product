<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id', 11);
            $table->string('product_identifier', 250)->nullable();
            $table->text('product_desc')->nullable();
            $table->integer('product_price', false, false, 11)->nullable();
            $table->integer('product_stock', false, false, 11)->nullable();
            $table->string('product_image_name', 250)->nullable();
            $table->timestamps();
            $table->index(['product_id', 'product_identifier']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
