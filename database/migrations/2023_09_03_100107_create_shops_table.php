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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')
      ->constrained('users')
      ->onUpdate('cascade')
      ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->enum('status', ['pending','approved','blocked', 'inActive'])->default('pending');
            $table->string('image')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('message')->nullable()->default('we received your new shop opening request we will contact you soon!');
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
        Schema::dropIfExists('shops');
    }
};
