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
        Schema::create('membership_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('withdraw_id')->constrained('withdraws')->onDelete('cascade');
            $table->string('card_name')->nullable();
            $table->integer('card_id')->nullable();
            $table->string('points')->nullable();
            $table->string('price')->nullable();
            $table->string('purchased_with')->nullable();
            $table->string('code')->nullable();
            $table->boolean('isUsed')->default(0);
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
        Schema::dropIfExists('membership_cards');
    }
};
