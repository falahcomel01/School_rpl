<x-app-layout>

    <div class="elite-container">

        {{-- Kartu Ucapan --}}
        <div class="elite-card elite-card-result text-center">

            {{-- HEADER --}}
            <div class="elite-result-header">
                <div class="elite-header-content">
                    <h2 class="elite-exam-title">
                        {{ $ujianSiswa->ujian->jenis_ujian }}
                    </h2>

                    <div class="elite-info-row">
                        @if($ujianSiswa->paket)
                            <span class="elite-badge elite-badge-paket">
                                Paket {{ $ujianSiswa->paket }}
                            </span>
                        @endif

                        <span class="elite-badge elite-badge-kelas">
                            {{ $ujianSiswa->ujian->kelas->nama_kelas ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- BODY --}}
            <div class="elite-result-body py-4">
                <h2 class="elite-congrats-text mb-2">🎉 Selamat! 🎉</h2>

                <p class="elite-subtext mb-3">
                    Anda telah menyelesaikan ujian ini dengan baik.
                </p>

                {{-- HASIL NILAI --}}
                @php
                    // Hitung jawaban PG
                    $totalSoal = $ujianSiswa->jawabanSiswas->count();
                    
                    // Filter soal PG
                    $soalPG = $ujianSiswa->jawabanSiswas->filter(function($jawaban) {
                        return $jawaban->ujianSoal && $jawaban->ujianSoal->soal && $jawaban->ujianSoal->soal->tipe_soal === 'pg';
                    })->count();
                    
                    // Filter soal Essay
                    $soalEssay = $ujianSiswa->jawabanSiswas->filter(function($jawaban) {
                        return $jawaban->ujianSoal && $jawaban->ujianSoal->soal && $jawaban->ujianSoal->soal->tipe_soal === 'essay';
                    })->count();
                    
                    // Hitung jawaban PG yang benar
                    $benarPG = $ujianSiswa->jawabanSiswas->filter(function($jawaban) {
                        return $jawaban->ujianSoal && 
                               $jawaban->ujianSoal->soal && 
                               $jawaban->ujianSoal->soal->tipe_soal === 'pg' && 
                               $jawaban->is_benar == 1;
                    })->count();
                    
                    $salahPG = $soalPG - $benarPG;
                    
                    // Cek apakah essay sudah dinilai semua (is_benar = null berarti belum dinilai)
                    $essayBelumDinilai = $ujianSiswa->jawabanSiswas->filter(function($jawaban) {
                        return $jawaban->ujianSoal && 
                               $jawaban->ujianSoal->soal && 
                               $jawaban->ujianSoal->soal->tipe_soal === 'essay' && 
                               is_null($jawaban->is_benar);
                    })->count();
                @endphp

                <div class="elite-score-container">
                    {{-- DETAIL JAWABAN --}}
                    <div class="elite-detail-grid">
                        {{-- PILIHAN GANDA --}}
                        @if($soalPG > 0)
                            <div class="elite-detail-card">
                                <div class="elite-detail-icon">
                                    <i class="fa-solid fa-check-circle"></i>
                                </div>
                                <div class="elite-detail-content">
                                    <div class="elite-detail-title">Pilihan Ganda</div>
                                    <div class="elite-detail-stats">
                                        <span class="stat-item stat-benar">
                                            <i class="fa-solid fa-check"></i> {{ $benarPG }} Benar
                                        </span>
                                        <span class="stat-item stat-salah">
                                            <i class="fa-solid fa-times"></i> {{ $salahPG }} Salah
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- ESSAY --}}
                        @if($soalEssay > 0)
                            <div class="elite-detail-card">
                                <div class="elite-detail-icon">
                                    <i class="fa-solid fa-file-alt"></i>
                                </div>
                                <div class="elite-detail-content">
                                    <div class="elite-detail-title">Essay</div>
                                    <div class="elite-detail-stats">
                                        <span class="stat-item">
                                            <i class="fa-solid fa-pen"></i> {{ $soalEssay }} Soal
                                        </span>
                                        @if($essayBelumDinilai > 0)
                                            <span class="stat-item stat-pending">
                                                <i class="fa-solid fa-clock"></i> {{ $essayBelumDinilai }} Belum Dinilai
                                            </span>
                                        @else
                                            <span class="stat-item stat-done">
                                                <i class="fa-solid fa-check-double"></i> Semua Dinilai
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="elite-divider my-4"></div>

                <small class="elite-timestamp">
                    <i class="fa-solid fa-clock me-1"></i>
                    Diselesaikan pada:
                    <strong>{{ \Carbon\Carbon::parse($ujianSiswa->waktu_selesai)->format('d M Y, H:i') }}</strong>
                </small>
            </div>
        </div>

        {{-- PEMBAHASAN SOAL --}}
        <div class="elite-card mt-4">
            <div class="elite-card-header">
                📝 Pembahasan Soal
            </div>
            <div class="elite-card-body">
                
                @foreach($ujianSiswa->jawabanSiswas as $index => $jawaban)
                    <div class="elite-soal-item {{ 
                        $jawaban->is_benar === true ? 'elite-soal-correct' : 
                        ($jawaban->is_benar === false ? 'elite-soal-wrong' : 'elite-soal-pending') 
                    }}">
                        
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="elite-soal-number">
                                <span class="elite-badge {{ 
                                    $jawaban->is_benar === true ? 'elite-badge-success' : 
                                    ($jawaban->is_benar === false ? 'elite-badge-danger' : 'elite-badge-warning') 
                                }}">
                                    Soal {{ $index + 1 }}
                                </span>
                            </h5>
                            
                            @if($jawaban->is_benar === true)
                                <span class="elite-badge elite-badge-success"><i class="fa-solid fa-check-circle me-1"></i> Benar</span>
                            @elseif($jawaban->is_benar === false)
                                <span class="elite-badge elite-badge-danger"><i class="fa-solid fa-times-circle me-1"></i> Salah</span>
                            @else
                                <span class="elite-badge elite-badge-warning"><i class="fa-solid fa-hourglass-half me-1"></i> Belum Dinilai</span>
                            @endif
                        </div>

                        <div class="elite-soal-question">
                            <strong>Pertanyaan:</strong> {{ $jawaban->ujianSoal->soal->soal_text }}
                        </div>

                        {{-- PILIHAN GANDA --}}
                        @if($jawaban->ujianSoal->soal->tipe_soal === 'pg')
                            <div class="elite-opsi-list">
                                @foreach($jawaban->ujianSoal->soal->opsiJawaban as $opsi)
                                    <div class="elite-opsi-item {{ 
                                        $opsi->is_benar ? 'elite-opsi-correct' : 
                                        ($opsi->id == $jawaban->opsi_jawaban_id && !$opsi->is_benar ? 'elite-opsi-wrong' : '') 
                                    }}">
                                        @if($opsi->is_benar)
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                        @elseif($opsi->id == $jawaban->opsi_jawaban_id)
                                            <i class="fa-solid fa-times-circle text-danger me-2"></i>
                                        @endif
                                        
                                        <strong>{{ $opsi->urutan }}.</strong> {{ $opsi->opsi_text }}
                                        
                                        @if($opsi->id == $jawaban->opsi_jawaban_id)
                                            <span class="elite-badge elite-badge-info ms-2">Jawaban Anda</span>
                                        @endif
                                        
                                        @if($opsi->is_benar)
                                            <span class="elite-badge elite-badge-success ms-2">Jawaban Benar</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        {{-- ESSAY --}}
                        @elseif($jawaban->ujianSoal->soal->tipe_soal === 'essay')
                            <div class="mb-3">
                                <strong>Jawaban Anda:</strong>
                                <div class="elite-essay-answer">
                                    {{ $jawaban->jawaban_essay ?? 'Tidak dijawab' }}
                                </div>
                            </div>

                            @if($jawaban->is_benar === null)
                                <div class="elite-info-box elite-info-warning">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    Jawaban essay Anda sedang dinilai oleh guru.
                                </div>
                            @else
                                <div class="elite-info-box elite-info-success">
                                    <i class="fa-solid fa-check-circle me-2"></i>
                                    Jawaban essay Anda sudah dinilai oleh guru.
                                </div>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-center mt-4">
            <a href="{{ route('ujian_siswa.index') }}" class="elite-btn elite-btn-primary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Daftar Ujian
            </a>
        </div>
    </div>

    {{-- STYLE --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
        }

        .elite-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 15px 40px;
        }

        .elite-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0px 10px 35px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        /* HEADER */
        .elite-result-header {
            background: linear-gradient(120deg, #b91c1c, #8b0f0f);
            padding: 25px 15px;
            color: white;
        }

        .elite-exam-title {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .elite-info-row {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* BADGES */
        .elite-badge {
            padding: 5px 10px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .elite-badge-paket {
            background: #ffe3e3;
            color: #8b0000;
            border: 1px solid #ffb3b3;
        }

        .elite-badge-kelas {
            background: #fff8dd;
            color: #704c00;
            border: 1px solid #ffe58a;
        }

        .elite-badge-success { background: #dcfce7; color: #166534; }
        .elite-badge-danger { background: #fee2e2; color: #b91c1c; }
        .elite-badge-warning { background: #fef9c3; color: #92400e; }
        .elite-badge-info { background: #dbeafe; color: #1e40af; }

        /* BODY */
        .elite-congrats-text {
            font-size: 22px;
            font-weight: 800;
            color: #374151;
        }

        .elite-subtext {
            font-size: 14px;
            color: #6b7280;
            max-width: 550px;
            margin: auto;
            line-height: 1.5;
        }

        /* SCORE CONTAINER */
        .elite-score-container {
            margin: 30px 0;
        }

        /* DETAIL GRID */
        .elite-detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .elite-detail-card {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px;
            text-align: left;
            transition: all 0.3s;
        }

        .elite-detail-card:hover {
            border-color: #b91c1c;
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.1);
        }

        .elite-detail-icon {
            font-size: 32px;
            color: #b91c1c;
            margin-bottom: 12px;
        }

        .elite-detail-title {
            font-size: 16px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 10px;
        }

        .elite-detail-stats {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }

        .stat-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            padding: 4px 10px;
            border-radius: 6px;
            width: fit-content;
        }

        .stat-benar {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .stat-salah {
            background: #fee2e2;
            color: #991b1b;
            font-weight: 600;
        }

        .stat-pending {
            background: #fef3c7;
            color: #78350f;
            font-weight: 600;
        }

        .stat-done {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .elite-divider {
            width: 70%;
            height: 1px;
            margin: auto;
            background: #e5e7eb;
        }

        .elite-timestamp {
            font-size: 13px;
            color: #6b7280;
        }

        /* CARD HEADER & BODY */
        .elite-card-header {
            background-color: #b91c1c;
            color: white;
            padding: 18px 24px;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .elite-card-body {
            padding: 24px;
        }

        /* Soal Item */
        .elite-soal-item {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
        }
        .elite-soal-correct {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
        }
        .elite-soal-wrong {
            background-color: #fef2f2;
            border-color: #fecaca;
        }
        .elite-soal-pending {
            background-color: #fffbeb;
            border-color: #fde68a;
        }
        .elite-soal-number {
            margin: 0;
            font-size: 1.1rem;
        }
        .elite-soal-question {
            background: #f8fafc;
            padding: 16px;
            border-radius: 10px;
            margin: 16px 0;
            font-size: 15px;
            line-height: 1.6;
        }

        /* Opsi */
        .elite-opsi-list {
            margin: 16px 0;
        }
        .elite-opsi-item {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            background: #fafafa;
        }
        .elite-opsi-correct {
            background: #dcfce7 !important;
            border-left: 3px solid #16a34a;
        }
        .elite-opsi-wrong {
            background: #fee2e2 !important;
            border-left: 3px solid #b91c1c;
        }

        /* Essay */
        .elite-essay-answer {
            background: #f1f5f9;
            padding: 16px;
            border-radius: 10px;
            font-style: italic;
            white-space: pre-wrap;
        }

        /* Info Box */
        .elite-info-box {
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 12px;
        }
        .elite-info-success {
            background: #dcfce7;
            color: #166534;
        }
        .elite-info-warning {
            background: #fef9c3;
            color: #92400e;
        }

        /* BUTTON */
        .elite-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 22px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            transition: .25s;
            text-decoration: none;
        }

        .elite-btn-primary {
            background: #b91c1c;
            color: white;
            box-shadow: 0 5px 15px rgba(185, 28, 28, 0.18);
        }

        .elite-btn-primary:hover {
            background: #991b1b;
            transform: scale(1.03);
        }

        /* RESPONSIVE */
        @media (max-width: 640px) {
            .elite-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-app-layout>