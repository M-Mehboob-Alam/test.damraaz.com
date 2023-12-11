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
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('orderId')->nullable();
            $table->bigInteger('shop_id');
            $table->string('shop_name');
            // $table->bigInteger('shop_items_count');
            // $table->json('shop_items');
            $table->bigInteger('shop_charges');
            // $table->string('total_amount')->nullable();
            // $table->bigInteger('total_items')->nullable();
            // $table->bigInteger('user_profit')->nullable();
            // $table->string('name')->nullable();
            // $table->text('address')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('payment_method')->nullable();
            // $table->string('city')->nullable();
            // $table->string('province')->nullable();
            // $table->text('area')->nullable();
            // $table->text('house')->nullable();
            // $table->text('street')->nullable();
            // $table->text('nearest')->nullable();
            $table->enum('status', ['processing','delivered','cancelled','pending','return','refund','onDelivery'])->default('pending');
            $table->text('message')->default('Thank you for placing Order! Your order is in review');

            // $table->string('screenshot')->nullable();
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
        Schema::dropIfExists('shop_orders');
    }
};
