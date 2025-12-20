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
        Schema::create('ekstrakurikulers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pembina_id')
                  ->constrained('pembinas')
                  ->cascadeOnDelete();

            $table->string('nama_extra');
            $table->string('deskripsi')->nullable();
            $table->string('jadwal')->nullable();
            $table->string('tempat')->nullable();

            // kolom kuota
            $table->integer('kuota')->default(0);
            $table->date('pendaftaran_mulai');
            $table->date('pendaftaran_selesai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikulers');
    }
};
