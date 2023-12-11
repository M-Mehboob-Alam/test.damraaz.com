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
        Schema::create('referral_bundles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_bundle_id')->constrained('product_bundles')->onDelete('cascade');
            $table->foreignId('refer_product_bundle_id')->constrained('product_bundles')->onDelete('cascade');
            $table->string('user_refer_by')->nullable();
            $table->string('level_no')->nullable();
            $table->string('level_user_name')->nullable();
            $table->string('rewardOn')->nullable();
            $table->string('points')->nullable();
            $table->string('commission')->nullable();
            $table->boolean('isActive')->default(1);

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
        Schema::dropIfExists('referral_bundles');
    }
};
