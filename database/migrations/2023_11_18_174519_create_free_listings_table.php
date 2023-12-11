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
        Schema::create('free_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users') ->onDelete('cascade');
            $table->string('item_title')->nullable();
            $table->string('item_description')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->decimal('item_price');
            $table->enum('status',['pending','cancelled','approved','completed'])->default('pending');
            $table->boolean('isActive')->default(0);
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
        Schema::dropIfExists('free_listings');
    }
};
