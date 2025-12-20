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
        Schema::create('jawaban_siswas', function (Blueprint $table) {
            $table->id();
             $table->foreignId('ujian_siswa_id')->nullable()->constrained('ujian_siswas')->onDelete('cascade');
    $table->foreignId('ujian_soal_id')
          ->constrained('ujian_soals')
          ->cascadeOnDelete();

    $table->foreignId('opsi_jawaban_id')
          ->nullable()
          ->constrained('opsi_jawabans')
          ->nullOnDelete();

    $table->text('jawaban_essay')->nullable();
    $table->dateTime('waktu_jawab')->nullable();
    $table->float('nilai')->default(0);
    $table->string('status_jawaban', 50)->nullable();
  $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswas');
    }
};
