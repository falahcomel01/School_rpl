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
        Schema::create('pembobotan_nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained('mapels')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->integer('bobot_tugas')->default(0); // persen (0-100)
            $table->integer('bobot_uts')->default(0);
            $table->integer('bobot_uas')->default(0);
            $table->string('semester', 20)->default('Ganjil'); // Ganjil/Genap
            $table->string('tahun_ajaran', 20)->default('2024/2025');
            $table->timestamps();
            
            // Unique constraint: 1 pembobotan per kelas-mapel-semester-tahun
            $table->unique(['kelas_id', 'mapel_id', 'semester', 'tahun_ajaran'], 'unique_pembobotan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembobotan_nilais');
    }
};
