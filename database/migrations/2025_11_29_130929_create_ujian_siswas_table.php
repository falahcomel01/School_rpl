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
        Schema::create('ujian_siswas', function (Blueprint $table) {
            $table->id();
          $table->foreignId('ujian_id')->constrained('ujians')
          ->cascadeOnDelete();
    $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();

    $table->dateTime('waktu_mulai')->nullable();
    $table->dateTime('waktu_selesai')->nullable();
    $table->string('status', 50)->default('belum_mulai');
      $table->timestamps();
});
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_siswas');
    }
};
