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
        Schema::create('measurement_sub_measurement', function (Blueprint $table) {
            $table->unsignedInteger('measurement_id');
            $table->unsignedInteger('sub_measurement_id');

            $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('cascade');
            $table->foreign('sub_measurement_id')->references('id')->on('sub_measurements')->onDelete('cascade');

            $table->primary(['measurement_id', 'sub_measurement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurement_sub_measurement');
    }
};
