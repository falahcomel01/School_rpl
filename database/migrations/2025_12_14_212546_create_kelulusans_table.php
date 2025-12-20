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
        Schema::create('kelulusans', function (Blueprint $table) {
            $table->id();
             $table->foreignId('siswa_id') ->constrained('siswas')->cascadeOnDelete();
              $table->foreignId('aturan_kelulusan_id')->constrained('aturan_kelulusans')->restrictOnDelete(); 
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->enum('status', ['lulus', 'tidak_lulus']);
            $table->year('tahun_lulus');
            $table->boolean('is_legacy')->default(false);
            $table->timestamps();
            $table->unique(['siswa_id', 'tahun_lulus']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelulusans');
    }
};
