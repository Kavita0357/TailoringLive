<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tailor_master_list', function (Blueprint $table) {
            $table->boolean('show_work_history')->default(1)->after('mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tailor_master_list', function (Blueprint $table) {
            $table->dropColumn('show_work_history');
        });
    }
};
