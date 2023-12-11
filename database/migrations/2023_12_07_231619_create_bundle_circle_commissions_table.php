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
        Schema::create('bundle_circle_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_circle_counter_id')->constrained('bundle_circle_counters')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('isAssign')->default(0);
            $table->boolean('isActive')->default(0);
            $table->boolean('isStop')->default(0);
            $table->bigInteger('amount')->nullable();
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
        Schema::dropIfExists('bundle_circle_commissions');
    }
};
