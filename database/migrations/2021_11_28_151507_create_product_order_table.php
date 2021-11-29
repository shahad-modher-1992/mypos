<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order', function (Blueprint $table) {
            $table->increments('id');
            // $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('order_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();

            $table->integer('qty')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_order');
    }
}
