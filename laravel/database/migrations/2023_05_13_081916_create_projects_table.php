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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->string('status')->default('creadted');
            $table->float('map_center_x')->nullable();
            $table->float('map_center_y')->nullable();
            $table->date('data_max')->nullable();
            $table->date('data_min')->nullable();
            $table->date('data_start')->nullable();
            $table->date('data_end')->nullable();
            $table->json('intersection_area')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
