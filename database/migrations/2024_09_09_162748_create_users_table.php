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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('password')->required()->nullable(false);
            $table->string('facebook')->nullable(true)->default('No registrado');
            $table->string('instagram')->nullable(true)->default('No registrado');
            $table->string('x')->nullable(true)->default('No registrado');
            $table->string('tiktok')->nullable(true)->default('No registrado');
            $table->string('linkedin')->nullable(true)->default('No registrado');
            $table->string('whatsapp')->nullable(true)->default('No registrado');
            $table->string('contact_number')->unique()->nullable(true);
            $table->string('contact_public')->nullable(true)->default(0);
            $table->string('is_active')->default(1);
            $table->string('profilephoto')->nullable(true)->default("https://res.cloudinary.com/ddcpkxmzm/image/upload/v1728677266/profilephotos/eopb0vgvwvsey93ohjqj.png");
            $table->string('headerphoto')->nullable(true)->default("https://res.cloudinary.com/ddcpkxmzm/image/upload/v1731872529/headerphotos/default_headder.jpg");
            $table->string('address')->nullable(true);
            $table->string('description')->nullable(true)->default("Usuario consumidor");
            $table->timestamp('email_verified_at')->nullable(true);
            $table->rememberToken();
            $table->foreignId('acounttype_id')->constrained('acounttypes')->noActionOnDelete()->default(2);
            $table->foreignId('professions_id')->constrained('professions')->noActionOnDelete()->default(2);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
