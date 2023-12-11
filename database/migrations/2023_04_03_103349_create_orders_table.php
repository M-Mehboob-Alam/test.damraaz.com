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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
          $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('orderId')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->text('area')->nullable();
            $table->text('house')->nullable();
            $table->text('street')->nullable();
            $table->text('nearest')->nullable();
            $table->enum('status', ['processing','delivered','cancelled','pendding','return','refund','confirm','on-the-way'])->default('processing');
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
};
