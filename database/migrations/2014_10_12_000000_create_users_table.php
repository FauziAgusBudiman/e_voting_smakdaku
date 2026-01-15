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
            $table->string('name');

            // Email tidak wajib (opsional / admin saja)
            $table->string('email')->nullable();

            // NISN wajib & unik (login utama siswa)
            $table->string('nisn')->nullable()->unique();

            $table->string('password');

            $table->enum('role', ['admin', 'voter'])->default('voter');

            // Menyimpan pilihan kandidat (opsional)
            $table->string('choice')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
