<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->string('customer_name', 30);
            $table->string('customer_mobile', 30);
            $table->string('customer_address', 255);
            $table->string('product_name', 30);
            $table->float('product_price');
            $table->integer('product_quantity');
            $table->float('shipping_charge');
            $table->float('discount');
            $table->float('total_charge');
            $table->date('delivery_date');
            $table->string('status', 30)->default('pending');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('courier_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('orders');
    }
}
