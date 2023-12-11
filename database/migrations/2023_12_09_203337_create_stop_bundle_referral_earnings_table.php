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
        Schema::create('stop_bundle_referral_earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('buy_product_bundle_id')->constrained('buy_product_bundles')->onDelete('cascade');
            $table->bigInteger('onStop')->nullable();
            $table->boolean('isStopped')->default(1);     
            $table->string('payment_slip')->nullable();       
            $table->string('payment_method')->nullable();       
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
        Schema::dropIfExists('stop_bundle_referral_earnings');
    }
};
