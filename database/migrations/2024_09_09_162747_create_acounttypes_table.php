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
        Schema::create('acounttypes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('detail');
            $table->timestamps();
        });

        DB::table('acounttypes')->insert([
            ['type' => 'Admin', 'detail' => 'Administrador de todo'],
            ['type' => 'User', 'detail' => 'Puede ver y citar'],
            ['type' => 'Emprendedor', 'detail' => 'Puede ver, crear servicios y CRUD de citas'],
            ['type' => 'Tester', 'detail' => 'Puede hacer pruebas']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acounttypes');
    }
};
