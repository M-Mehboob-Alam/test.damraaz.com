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
        Schema::table('product_bundles', function (Blueprint $table) {
            $table->bigInteger('delivery_charges')->nullable();
            $table->bigInteger('delivery_days')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_bundles', function (Blueprint $table) {
            $table->dropColumn('delivery_charges');
            $table->dropColumn('delivery_days');
        });
    }
};
