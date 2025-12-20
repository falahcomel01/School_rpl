<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JawabanSiswa;

class FixJawabanIsBenar extends Command
{
    protected $signature = 'jawaban:fix-is-benar';

    protected $description = 'Fix is_benar field for existing jawaban_siswas records';

    public function handle()
    {
        $this->info('Fixing is_benar for existing records...');

        $jawabans = JawabanSiswa::with(['opsiJawaban', 'ujianSoal.soal'])->get();
        $updated = 0;

        foreach ($jawabans as $jawaban) {
            $soal = $jawaban->ujianSoal->soal;
            
            if (in_array($soal->tipe_soal, ['pilihan_ganda', 'benar_salah'])) {
                if ($jawaban->opsi_jawaban_id && $jawaban->opsiJawaban) {
                    $jawaban->is_benar = $jawaban->opsiJawaban->is_benar;
                    $jawaban->save();
                    $updated++;
                }
            } elseif ($soal->tipe_soal === 'essay') {
                if ($jawaban->status_jawaban === 'dinilai') {
                    $jawaban->is_benar = $jawaban->nilai > 0;
                    $jawaban->save();
                    $updated++;
                } else {
                    $jawaban->is_benar = null;
                    $jawaban->save();
                }
            }
        }

        $this->info("Updated {$updated} records successfully!");
        return 0;
    }
}
