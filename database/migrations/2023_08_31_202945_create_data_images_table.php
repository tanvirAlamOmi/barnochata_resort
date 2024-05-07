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
        Schema::create('data_images', function (Blueprint $table) {
            $table->id();
            $table->enum('model',['room','service','feature','facility'])->index();
            $table->integer('model_id')->index()->unsigned();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('title')->nullable();
            $table->integer('serial_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_images');
    }
};
