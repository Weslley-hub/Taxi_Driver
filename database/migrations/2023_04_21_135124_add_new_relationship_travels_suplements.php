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
        Schema::create('travelsSuplements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('idTravel')->constrained()->references('id')->on('travel');
            $table->foreignId('idSuplements')->constrained()->references('id')->on('suplements');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
