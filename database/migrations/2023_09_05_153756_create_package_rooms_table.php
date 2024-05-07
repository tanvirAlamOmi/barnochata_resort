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
        Schema::create('package_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id')->index()->nullable()->unsigned();
            $table->integer('room_id')->index()->nullable()->unsigned();
            $table->integer('default_guest')->nullable();
            $table->double('price',8,2)->nullable();
            $table->double('extra_person_per_adult',8,2)->nullable();
            $table->double('extra_person_per_child',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_rooms');
    }
};
