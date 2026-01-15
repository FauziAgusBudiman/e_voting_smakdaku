<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Email jadi opsional
            $table->string('email')->nullable()->change();

            // JANGAN tambah unique nisn lagi (sudah ada)
            // $table->string('nisn')->unique()->change(); ❌

            // Tambah flag voting
            $table->boolean('has_voted')->default(false)->after('choice');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('email')->nullable(false)->change();

            $table->dropColumn('has_voted');
        });
    }
};
