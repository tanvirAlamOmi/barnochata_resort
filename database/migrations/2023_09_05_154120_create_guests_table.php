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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->index()->nullable()->unsigned();
            $table->integer('booking_no')->index()->nullable()->unsigned();
            $table->enum('type',['local','foreign'])->nullable();
            $table->string('title')->nullable();
            $table->string('full_name')->nullable();
            $table->string('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nid')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_mobile_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_issue_place')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->string('visa_imm_no')->nullable();
            $table->string('coming_from')->nullable();
            $table->string('going_to')->nullable();
            $table->string('expected_langth_of_staying')->nullable();
            $table->date('date_of_entry_in_bd')->nullable();
            $table->string('purpose_of_visit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
