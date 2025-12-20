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
        Schema::create('rekomendasi_jurusans', function (Blueprint $table) {
            $table->id();
              $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('jurusan_id')
                ->nullable()
                ->constrained('jurusans')
                ->nullOnDelete();

            
            $table->enum('validasi', ['pending','disetujui','ditolak'])->default('pending');
            $table->text('catatan_wali_kelas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_jurusans');
    }
};
