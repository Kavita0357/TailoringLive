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
        Schema::create('cloth_style', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cloth_id');
            $table->unsignedInteger('style_id');

            $table->foreign('cloth_id')->references('id')->on('cloths')->onDelete('cascade');
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade');

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
        Schema::dropIfExists('cloth_style');
    }
};
