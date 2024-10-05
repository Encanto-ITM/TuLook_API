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
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('profession');
            $table->string('detail');
            $table->timestamps();
        });

        DB::table('professions')->insert([
            ['profession' => 'Admin', 'detail' => 'admin'],
            ['profession' => 'Usuario', 'detail' => 'Campo para los usuario por defecto'],
            ['profession' => 'Estilista', 'detail' => 'Encargad@ en estetica personal'],
            ['profession' => 'Manicura', 'detail' => 'Encargad@ en manicura'],
            ['profession' => 'Pedicura', 'detail' => 'Encargad@ en pedicura'],
            ['profession' => 'Peluquero', 'detail' => 'Encargad@ en cortar pelo'],
            ['profession' => 'Barbero', 'detail' => 'Encargad@ en barberia'],
            ['profession' => 'Cuidador de piel', 'detail' => 'Encargad@ en cuidado de la piel'],
            ['profession' => 'Depiladora', 'detail' => 'Encargad@ en depilacion'],
            ['profession' => 'Maquilladora', 'detail' => 'Encargad@ en maquillaje'],
            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};
