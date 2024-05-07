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
        Schema::create('text_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->index()->unsigned()->nullable()->default(0);
            $table->string('title_icon')->nullable();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('text_contents');
    }
};
