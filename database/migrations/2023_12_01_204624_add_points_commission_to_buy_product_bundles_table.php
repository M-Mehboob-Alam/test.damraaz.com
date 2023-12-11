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
        Schema::table('buy_product_bundles', function (Blueprint $table) {
            $table->bigInteger('points');
            $table->bigInteger('commission');
            $table->bigInteger('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buy_product_bundles', function (Blueprint $table) {
            $table->dropColumn('points');
            $table->dropColumn('commission');
            $table->dropColumn('level');
        });
    }
};
