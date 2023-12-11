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
        Schema::table('order_details', function (Blueprint $table) {
            $table->text('product_name')->nullable();
            $table->json('product_images')->nullable();
            $table->string('product_image')->nullable();
            $table->string('shop_name')->nullable();

            $table->string('shop_image')->nullable();
            $table->string('shop_city')->nullable();
            $table->string('shop_province')->nullable();
            $table->string('shop_mobile')->nullable();
            $table->text('shop_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('product_name');
            $table->dropColumn('product_images');
            $table->dropColumn('product_image');
            $table->dropColumn('shop_name');

            $table->dropColumn('shop_image');
            $table->dropColumn('shop_city');
            $table->dropColumn('shop_province');
            $table->dropColumn('shop_mobile');
            $table->dropColumn('shop_address');
        });
    }
};
