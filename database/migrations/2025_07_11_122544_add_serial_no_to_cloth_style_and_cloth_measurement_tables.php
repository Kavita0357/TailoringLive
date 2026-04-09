<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cloth_style', function (Blueprint $table) {
            $table->integer('serial_no')->nullable()->after('style_id');
        });

        Schema::table('cloth_measurement', function (Blueprint $table) {
            $table->integer('serial_no')->nullable()->after('measurement_id');
        });
    }

    public function down(): void
    {
        Schema::table('cloth_style', function (Blueprint $table) {
            $table->dropColumn('serial_no');
        });

        Schema::table('cloth_measurement', function (Blueprint $table) {
            $table->dropColumn('serial_no');
        });
    }
};
