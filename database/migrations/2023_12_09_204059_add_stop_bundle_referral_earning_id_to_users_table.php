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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('isStopped')->default(0);
            $table->bigInteger('stop_bundle_referral_earning_id')->nullable();
            $table->boolean('isBlocked')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('isStopped');
            $table->dropColumn('stop_bundle_referral_earning_id');
            $table->dropColumn('isBlocked');
        });
    }
};
