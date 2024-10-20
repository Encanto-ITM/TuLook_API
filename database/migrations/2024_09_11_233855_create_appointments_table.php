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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('applicant')->constrained('users');
            $table->dateTime('date');
            $table->enum ('status', ['Pendiente', 'Aceptado', 'Modificado', 'Cancelado'])->default('Pendiente');
            $table->integer('total');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
