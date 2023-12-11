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
        Schema::create('circle_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('circle_counter_id')->nullable();
            $table->integer('amount');
            $table->string('name')->default('sale');
            $table->boolean('isAssign')->default(0);
            $table->bigInteger('next_counter_divisible_by');
            // $table->enum('status',['pending','clear'])->default('pending');
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
        Schema::dropIfExists('circle_commissions');
    }
};
