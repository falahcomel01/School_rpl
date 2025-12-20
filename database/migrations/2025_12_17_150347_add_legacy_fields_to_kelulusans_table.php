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
        Schema::table('kelulusans', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropUnique(['siswa_id', 'tahun_lulus']);
            $table->unsignedBigInteger('siswa_id')->nullable()->change();
            $table->string('nama_siswa_legacy')->nullable()->after('siswa_id');
            $table->string('jurusan_legacy')->nullable()->after('nama_siswa_legacy');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelulusans', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn(['nama_siswa_legacy', 'jurusan_legacy']);
            $table->unsignedBigInteger('siswa_id')->nullable(false)->change();
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->unique(['siswa_id', 'tahun_lulus']);
        });
    }
};
