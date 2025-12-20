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
        Schema::table('rekap_nilai_akhirs', function (Blueprint $table) {
            $table->foreignId('pembobotan_nilai_id')->nullable()->after('id')->constrained('pembobotan_nilais')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_nilai_akhirs', function (Blueprint $table) {
            $table->dropForeign(['pembobotan_nilai_id']);
            $table->dropColumn('pembobotan_nilai_id');
        });
    }
};
