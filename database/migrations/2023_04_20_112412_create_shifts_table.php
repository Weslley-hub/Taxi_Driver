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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("taxi_id");
            $table->unsignedBigInteger("driver_id");
            $table->dateTime('dateStart');
            $table->dateTime('dateFinish')->nullable();
            $table->integer('kmStart');
            $table->integer('kmFinish')->nullable();
            $table->foreign('taxi_id')->references('id')->on('taxis');
            $table->foreign('driver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
