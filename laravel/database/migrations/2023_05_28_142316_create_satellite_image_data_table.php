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
        Schema::create('satellite_image_data', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('satellite_image_id')->unsigned();
            $table->foreign('satellite_image_id')->references('id')->on('satellite_images');

            $table->json('data');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satellite_image_data');
    }
};
