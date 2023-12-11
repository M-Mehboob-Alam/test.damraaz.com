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
        Schema::create('bundle_stopped_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('stop_bundle_referral_earning_id')->constrained('stop_bundle_referral_earnings')->onDelete('cascade');
            $table->enum('status', ['pending', 'cancelled', 'approved'])->default('pending');
            $table->string('amount')->nullable();
            $table->string('slip')->nullable();
            $table->string('payment_type')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('bundle_stopped_payments');
    }
};
