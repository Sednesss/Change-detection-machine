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
        Schema::create('channel_emissions_data', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('channel_emission_id')->unsigned();
            $table->foreign('channel_emission_id')->references('id')->on('channel_emissions')->onDelete('cascade');

            $table->integer('position');
            $table->json('data');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_emissions_data');
    }
};
