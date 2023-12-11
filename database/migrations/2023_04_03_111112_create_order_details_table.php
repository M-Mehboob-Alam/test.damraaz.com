<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
             $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
             $table->foreignId('product_id')->constrained()->cascadeOnDelete();
             $table->bigInteger('shop_id')->nullable();
             $table->integer('quantity')->nullable();
             $table->integer('price')->nullable();
             $table->integer('discount_price')->nullable();
             $table->bigInteger('profit')->nullable();
             $table->bigInteger('amount')->nullable();
             $table->integer('delivery_charges')->nullable();
             $table->integer('delivery_days')->nullable();
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
        Schema::dropIfExists('order_details');
    }
};
