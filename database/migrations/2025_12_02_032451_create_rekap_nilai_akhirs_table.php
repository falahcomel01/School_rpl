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
        Schema::create('rekap_nilai_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained('mapels')->cascadeOnDelete();
            $table->decimal('rata_rata_tugas', 5, 2)->nullable()->default(0); // 0-100
            $table->decimal('nilai_uts', 5, 2)->nullable()->default(0);
            $table->decimal('nilai_uas', 5, 2)->nullable()->default(0);
            $table->decimal('nilai_akhir', 5, 2)->nullable()->default(0);
            $table->string('semester', 20)->default('Ganjil');
            $table->string('tahun_ajaran', 20)->default('2024/2025');
            $table->timestamps();
            
            // Unique constraint: 1 rekap per siswa-mapel-semester-tahun
            $table->unique(['siswa_id', 'mapel_id', 'semester', 'tahun_ajaran'], 'unique_rekap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_nilai_akhirs');
    }
};
