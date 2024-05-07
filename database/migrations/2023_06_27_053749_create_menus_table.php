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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable()->index()->unsigned();
            $table->string('name')->nullable()->unique();
            $table->string('slug')->nullable();
            $table->integer('position')->nullable();
            $table->enum('type',['navigation','page','external_link'])->nullable();
            $table->string('link_url')->nullable();
            $table->string('display_options')->nullable(); //,['header','footer','sidebar','all']
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
