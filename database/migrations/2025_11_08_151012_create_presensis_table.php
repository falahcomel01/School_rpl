<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwals')->onDelete('set null');
            $table->foreignId('perizinan_id')->nullable()->constrained('perizinans')->onDelete('set null');
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('hadir');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
