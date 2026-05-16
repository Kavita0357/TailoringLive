<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer_sms_balance_history', function (Blueprint $table) {
            if (!Schema::hasColumn('transfer_sms_balance_history', 'is_reversed')) {
                $table->boolean('is_reversed')->nullable()->default(null)->after('amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer_sms_balance_history', function (Blueprint $table) {
            if (Schema::hasColumn('transfer_sms_balance_history', 'is_reversed')) {
                $table->dropColumn('is_reversed');
            }
        });
    }
};
