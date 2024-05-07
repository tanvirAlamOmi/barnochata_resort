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
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->index()->nullable()->unsigned();
            $table->integer('room_id')->index()->nullable()->unsigned();
            $table->integer('package_id')->index()->nullable()->unsigned();
            $table->datetime('check_in_date')->nullable();
            $table->datetime('check_out_date')->nullable();
            $table->double('price',8,2)->nullable();
            $table->integer('default_guest')->nullable()->default(0);
            $table->double('extra_person_per_adult',8,2)->nullable();
            $table->double('extra_person_per_child',8,2)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rooms');
    }
};
