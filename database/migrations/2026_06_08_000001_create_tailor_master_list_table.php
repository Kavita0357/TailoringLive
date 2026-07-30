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
        Schema::dropIfExists('tailor_master_list');
        Schema::create('tailor_master_list', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->timestamp('added_on')->useCurrent();
            $table->unsignedInteger('total_completed_orders')->default(0);
            $table->decimal('total_wages', 15, 2)->default(0.00);
            $table->decimal('total_wages_paid', 15, 2)->default(0.00);
            $table->decimal('total_wages_due', 15, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tailor_master_list');
    }
};
