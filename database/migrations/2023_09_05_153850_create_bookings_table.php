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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->integer('total_adult')->nullable();
            $table->integer('total_child')->nullable();
            $table->date('booking_date')->nullable();
            $table->datetime('check_in_date')->nullable();
            $table->datetime('check_out_date')->nullable();
            $table->text('booking_note')->nullable();
            $table->integer('gross_total')->nullable()->default(0);
            $table->tinyinteger('status')->nullable();
            $table->text('response_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
