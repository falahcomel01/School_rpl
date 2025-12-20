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
        Schema::create('presensi_ekstras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extra_peserta_id')->constrained('extra_pesertas')->cascadeOnDelete();
            $table->foreignId('perizinan_id')->nullable()->constrained('perizinans')->nullOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('hadir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_ekstras');
    }
};
