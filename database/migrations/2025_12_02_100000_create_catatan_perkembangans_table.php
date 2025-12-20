<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatan_perkembangans', function (Blueprint $table) {
            $table->id();
           $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
    $table->foreignId('walikelas_id')->constrained('walikelas')->cascadeOnDelete();
    $table->text('catatan_akademik')->nullable();
$table->text('catatan_non_akademik')->nullable();

    $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_perkembangans');
    }
};
