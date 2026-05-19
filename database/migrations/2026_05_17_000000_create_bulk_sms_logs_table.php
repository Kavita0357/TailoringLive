<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bulk_sms_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sms_log_id')->nullable();
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('created_by')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('recipient_number');
            $table->text('message')->nullable();
            $table->enum('status', ['Sent', 'failed', 'Scheduled', 'Pending'])->default('Sent');
            $table->json('api_response')->nullable();
            $table->decimal('cost', 8, 2)->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->foreign('sms_log_id')->references('id')->on('sms_logs')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_sms_logs');
    }
};
