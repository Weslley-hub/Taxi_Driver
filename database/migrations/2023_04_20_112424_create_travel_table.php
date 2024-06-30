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
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('travelType', ['Taxímetro', 'Segurador' , 'Combinado']);
            $table->dateTime('dateStart');
            $table->dateTime('dateFinish');
            $table->string('kmStart');
            $table->string('kmFinish');
            $table->bigInteger('price');
            $table->string('destiny');
            $table->string('latitudeStart');
            $table->string('longitudeStart');
            $table->string('latitudeEnd');
            $table->string('longitudeEnd');
            $table->string('waiting');
            $table->enum('type', ['Sinistrado', 'Assistência em Viagem']);
            $table->string('parking');
            $table->string('whoReceived');
            $table->string('toll');
            $table->foreignId('idShift')->constrained()->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};
