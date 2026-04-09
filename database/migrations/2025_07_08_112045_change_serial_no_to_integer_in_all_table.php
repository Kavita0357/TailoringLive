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
        Schema::table('sub_measurements', function (Blueprint $table) {
             $table->integer('serial_no')->nullable()->change();
        });

        Schema::table('cloths', function (Blueprint $table) {
            $table->integer('serial_no')->change();
        });

        Schema::table('styles', function (Blueprint $table) {
            $table->integer('serial_no')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_measurements', function (Blueprint $table) {
            $table->string('serial_no')->change();
        });

        Schema::table('cloths', function (Blueprint $table) {
            $table->string('serial_no')->change();
        });

        Schema::table('styles', function (Blueprint $table) {
            $table->string('serial_no')->change();
        });
    }
};
