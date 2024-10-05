<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_service', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insertar valores iniciales
        DB::table('type_service')->insert([
            ['name' => 'Barbería'],
            ['name' => 'Estilismo'],
            ['name' => 'Manicura'],
            ['name' => 'Cejas'],
            ['name' => 'Pedicura'],
            ['name' => 'Depilación'],
            ['name' => 'Cuidado de la piel'],
            ['name' => 'Corte de pelo damas'],
            ['name' => 'Corte de pelo caballeros'],
            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_service');
    }
};
