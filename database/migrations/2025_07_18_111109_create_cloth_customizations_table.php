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
        Schema::create('cloth_customizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cloth_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->json('measurements')->nullable();
            $table->json('styles')->nullable();

            $table->foreign('cloth_id')->references('id')->on('cloths')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');

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
        Schema::dropIfExists('cloth_customizations');
    }
};
