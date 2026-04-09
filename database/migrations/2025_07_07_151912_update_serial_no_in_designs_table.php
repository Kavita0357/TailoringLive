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
        Schema::table('designs', function (Blueprint $table) {
            // $table->dropUnique(['serial_no']); // Remove unique constraint
        });
    }

    public function down()
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->unique('serial_no'); // Re-add unique if rolling back
        });
    }
};
