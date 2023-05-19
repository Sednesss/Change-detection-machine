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
        Schema::create('channel_emissions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('satellite_image_id')->unsigned();
            $table->foreign('satellite_image_id')->references('id')->on('satellite_images');

            $table->string('channel_name')->nullable();
            $table->string('filename');
            $table->text('path');
            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_emissions');
    }
};
