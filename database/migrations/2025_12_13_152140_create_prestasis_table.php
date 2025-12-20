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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
    $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
    $table->string('nama_prestasi');
    $table->enum('jenis', ['akademik','non-akademik',]);
    $table->enum('tingkat', ['sekolah','kecamatan','kabupaten','provinsi','nasional','internasional']);
    $table->string('peringkat')->nullable();
    $table->date('tanggal');
    $table->string('file_bukti')->nullable();
    $table->text('keterangan')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
