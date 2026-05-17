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
        if (!Schema::hasTable('transfer_sms_balance_history')) {
            Schema::create('transfer_sms_balance_history', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('transferred_by'); // User ID who transferred
                $table->unsignedBigInteger('transferred_to'); // User ID who received
                $table->decimal('amount', 15, 2); // Amount transferred
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_sms_balance_history');
    }
};
