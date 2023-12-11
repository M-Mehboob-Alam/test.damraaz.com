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
        Schema::create('buy_product_bundles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_bundle_id')->constrained('product_bundles')->onDelete('cascade');
            $table->string('slip')->nullable();
            $table->enum('status', ['pending','approved','cancelled'])->default('pending');
            $table->text('message')->default('your payment is in review');
            $table->string('payment_method')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('isOrdered')->default(0);
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
        Schema::dropIfExists('buy_product_bundles');
    }
};
