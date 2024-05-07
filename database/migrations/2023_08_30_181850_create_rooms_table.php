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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->enum('category',['room','suite','cottage'])->nullable();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('default_image')->nullable();
            $table->integer('guest_capacity')->nullable()->default(2);
            $table->integer('max_guest_capacity')->nullable()->default(1);
            $table->double('price',8,2)->nullable();
            $table->double('extra_person_per_adult',8,2)->nullable();
            $table->double('extra_person_per_child',8,2)->nullable();
            $table->string('facilities')->nullable();
            $table->integer('serial_no')->nullable();
            $table->tinyinteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
