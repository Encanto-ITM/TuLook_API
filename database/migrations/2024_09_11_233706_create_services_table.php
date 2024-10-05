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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->foreignId('owner_id')->constrained('users');
            $table->string('image')->nullable(true);
            $table->string('price')->nullable(false);
            $table->string('details')->nullable(false);
            $table->string('schedule')->nullable(false)->default("Lunes a viernes");
            $table->string('material_list')->nullable(true);
            $table->enum('mode', ['Solo local', 'Voy al lugar', 'Ambos servicios'])->default('Voy al lugar');
            $table->string('is_active')->default(1);
            $table->string('considerations')->nullable(false);
            $table->string('aprox_time')->nullable(true);
            $table->string('type_service_id')->constrained('type_service')->noActionOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
