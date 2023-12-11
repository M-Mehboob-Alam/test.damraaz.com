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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained() ->onUpdate('cascade')->onDelete('cascade');
            $table->string('account_title')->nullable();
            $table->string('account_no')->nullable();
            $table->string('amount')->nullable();
            $table->enum('payment_type',['easypaisa','jazzcash','bank'])->nullable();
            $table->string('bank_name')->nullable();
            $table->enum('status',['pending','cancelled','approved','completed'])->default('pending');
            $table->text('message')->default('Your withdrawal request is in pending.');
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
        Schema::dropIfExists('withdraws');
    }
};
