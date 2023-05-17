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
        Schema::create('satellite_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->string('status')->default('creadted');
            $table->float('map_center_x')->nullable();
            $table->float('map_center_y')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satellite_images');
    }
};
