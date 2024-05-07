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
        Schema::create('file_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->index()->unsigned()->nullable()->default(0);
            $table->integer('text_content_id')->index()->unsigned()->nullable()->default(0);
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('file')->nullable();
            $table->text('description')->nullable();
            $table->string('download_link')->nullable();
            $table->integer('serial_no')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_contents');
    }
};
