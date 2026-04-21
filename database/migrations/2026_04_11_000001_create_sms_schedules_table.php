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
        Schema::create('sms_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('sender_id');
            $table->text('recipients')->nullable();
            $table->text('numbers')->nullable();
            $table->text('message');
            $table->string('schedule_type')->default('now');
            $table->timestamp('send_at')->nullable();
            $table->string('status')->default('pending');
            $table->longText('api_response')->nullable();
            $table->timestamp('processed_at')->nullable();
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
        Schema::dropIfExists('sms_schedules');
    }
};
