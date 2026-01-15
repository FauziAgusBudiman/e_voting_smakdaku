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
    Schema::create('candidates', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('kelas'); // Tambahan baru
        $table->string('picture')->nullable();
        $table->string('resume')->nullable(); // Untuk bukti organisasi
        $table->text('visi'); // Tambahan baru
        $table->text('misi'); // Tambahan baru
        $table->integer('election_number')->unique()->nullable(); // Dibuat nullable agar bisa daftar dulu
        $table->integer('total_voter')->default(0); // Default 0
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
