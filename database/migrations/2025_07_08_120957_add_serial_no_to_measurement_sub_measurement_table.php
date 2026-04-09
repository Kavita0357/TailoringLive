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
        Schema::table('measurement_sub_measurement', function (Blueprint $table) {
            $table->integer('serial_no')->nullable()->after('sub_measurement_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measurement_sub_measurement', function (Blueprint $table) {
            $table->dropColumn('serial_no');
        });
    }
};
