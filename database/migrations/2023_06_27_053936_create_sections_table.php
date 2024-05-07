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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->index()->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('heading')->nullable();
            $table->string('property')->nullable();
            $table->string('image')->nullable();
            $table->string('display_type')->nullable();
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
        Schema::dropIfExists('sections');
    }
};
