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
        Schema::create('order_product_bundles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('buy_product_bundle_id')->constrained('buy_product_bundles')->onDelete('cascade');
            $table->foreignId('product_bundle_id')->constrained('product_bundles')->onDelete('cascade');
            $table->enum('status', ['pending', 'onDelivery', 'delivered', 'processing', 'cancelled','return', 'refund'])->default('pending');
            $table->string('message')->default('your payment & address details is in review!');
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('delivery_charges')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('order_product_bundles');
    }
};
