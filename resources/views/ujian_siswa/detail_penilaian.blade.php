<x-app-layout>
    
    <div class="container-fluid py-4">

        {{-- HITUNG DATA UNTUK BOBOT --}}
        @php
            // Pisahkan soal PG dan Essay
            $soalPG = $ujianSiswa->jawabanSiswas->filter(function($j) {
                return in_array($j->ujianSoal->soal->tipe_soal, ['pg', 'pilihan_ganda', 'benar_salah']);
            });
            
            $soalEssay = $ujianSiswa->jawabanSiswas->filter(function($j) {
                return $j->ujianSoal->soal->tipe_soal === 'essay';
            });

            // Hitung PG
            $totalSoalPG = $soalPG->count();
            $benarPG = $soalPG->where('is_benar', true)->count();
            $nilaiPG = $totalSoalPG > 0 ? ($benarPG / $totalSoalPG) * 100 : 0;
            $bobotPG = 40; // 40%
            $nilaiPGDenganBobot = ($nilaiPG * $bobotPG) / 100;

            // Hitung Essay
            $totalSoalEssay = $soalEssay->count();
            $maxNilaiEssay = $soalEssay->sum(fn($j) => $j->ujianSoal->soal->bobot ?? 5);
            $nilaiEssayDidapat = $soalEssay->sum('nilai');
            $nilaiEssay = $maxNilaiEssay > 0 ? ($nilaiEssayDidapat / $maxNilaiEssay) * 100 : 0;
            $bobotEssay = 60; // 60%
            $nilaiEssayDenganBobot = ($nilaiEssay * $bobotEssay) / 100;

            // Nilai Akhir
            $nilaiAkhir = $nilaiPGDenganBobot + $nilaiEssayDenganBobot;

            // Cek essay belum dinilai
            $essayBelumDinilai = $soalEssay->where('is_benar', null)->count();
        @endphp

       {{-- RINGKASAN INFO SISWA --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row justify-content-center text-center">

            <div class="col-md-3 mb-3 mb-md-0">
                <small class="text-muted d-block">Nama Siswa</small>
                <h6 class="fw-bold mb-0">
                    {{ $ujianSiswa->siswa->user->name ?? 'N/A' }}
                </h6>
            </div>

            <div class="col-md-3 mb-3 mb-md-0">
                <small class="text-muted d-block">NIS</small>
                <h6 class="fw-bold mb-0">
                    {{ $ujianSiswa->siswa->user->username ?? '-' }}
                </h6>
            </div>

            <div class="col-md-3">
                <small class="text-muted d-block">Paket</small>
                <h6 class="fw-bold mb-0">
                    @if($ujianSiswa->paket)
                        <span class="badge bg-dark px-3 py-2">
                            {{ $ujianSiswa->paket }}
                        </span>
                    @else
                        -
                    @endif
                </h6>
            </div>

        </div>
    </div>
</div>


        {{-- BREAKDOWN NILAI DENGAN BOBOT --}}
        <div class="row mb-4">
            {{-- NILAI PG (40%) --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-check-square text-primary me-2"></i>
                                Pilihan Ganda
                            </h5>
                            <span class="badge bg-primary fs-6">Bobot {{ $bobotPG }}%</span>
                        </div>

                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <small class="text-muted d-block">Total Soal</small>
                                <h4 class="fw-bold mb-0">{{ $totalSoalPG }}</h4>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Benar</small>
                                <h4 class="fw-bold text-success mb-0">{{ $benarPG }}</h4>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Salah</small>
                                <h4 class="fw-bold text-danger mb-0">{{ $totalSoalPG - $benarPG }}</h4>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Poin Didapat</small>
                                <strong>{{ number_format($nilaiPGDenganBobot, 1) }} / {{ $bobotPG }}</strong>
                            </div>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-primary" style="width: {{ ($nilaiPGDenganBobot / $bobotPG) * 100 }}%">
                                    {{ number_format($nilaiPG, 1) }}%
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-primary mb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fa-solid fa-calculator me-2"></i>Kontribusi ke Nilai Akhir</span>
                                <strong class="fs-5">{{ number_format($nilaiPGDenganBobot, 1) }} poin</strong>
                            </div>
                            <small class="text-muted d-block mt-1">
                                {{ $benarPG }}/{{ $totalSoalPG }} benar × {{ $bobotPG }}% = {{ number_format($nilaiPGDenganBobot, 1) }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- NILAI ESSAY (60%) --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-pen-to-square text-info me-2"></i>
                                Essay
                            </h5>
                            <span class="badge bg-info fs-6">Bobot {{ $bobotEssay }}%</span>
                        </div>

                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <small class="text-muted d-block">Total Soal</small>
                                <h4 class="fw-bold mb-0">{{ $totalSoalEssay }}</h4>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Sudah Dinilai</small>
                                <h4 class="fw-bold text-success mb-0">{{ $totalSoalEssay - $essayBelumDinilai }}</h4>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Belum Dinilai</small>
                                <h4 class="fw-bold text-warning mb-0">{{ $essayBelumDinilai }}</h4>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Poin Didapat</small>
                                <strong>{{ number_format($nilaiEssayDenganBobot, 1) }} / {{ $bobotEssay }}</strong>
                            </div>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-info" style="width: {{ ($nilaiEssayDenganBobot / $bobotEssay) * 100 }}%">
                                    {{ number_format($nilaiEssay, 1) }}%
                                </div>
                            </div>
                            <small class="text-muted d-block mt-1">
                                {{ number_format($nilaiEssayDidapat, 1) }} dari {{ $maxNilaiEssay }} poin
                            </small>
                        </div>

                        @if($essayBelumDinilai > 0)
                            <div class="alert alert-warning mb-0">
                                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                <strong>{{ $essayBelumDinilai }}</strong> soal essay belum dinilai
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fa-solid fa-calculator me-2"></i>Kontribusi ke Nilai Akhir</span>
                                    <strong class="fs-5">{{ number_format($nilaiEssayDenganBobot, 1) }} poin</strong>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    {{ number_format($nilaiEssay, 1) }}% × {{ $bobotEssay }}% = {{ number_format($nilaiEssayDenganBobot, 1) }}
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- DETAIL JAWABAN --}}
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0 fw-bold">Detail Jawaban Siswa</h5>
            </div>
            <div class="card-body">

                @foreach($ujianSiswa->jawabanSiswas as $index => $jawaban)
                    <div class="mb-4 p-4 border rounded {{ $jawaban->is_benar === true ? 'border-success' : ($jawaban->is_benar === false ? 'border-danger' : 'border-warning bg-warning bg-opacity-10') }}">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="fw-bold mb-0">
                                Soal {{ $index + 1 }}
                                <span class="badge {{ $jawaban->ujianSoal->soal->tipe_soal === 'essay' ? 'bg-info' : 'bg-secondary' }}">
                                    {{ Str::title(str_replace('_', ' ', $jawaban->ujianSoal->soal->tipe_soal)) }}
                                </span>
                            </h5>
                            
                            @if($jawaban->is_benar === true)
                                <span class="badge bg-success fs-6"><i class="fa-solid fa-check-circle me-1"></i> Benar</span>
                            @elseif($jawaban->is_benar === false)
                                <span class="badge bg-danger fs-6"><i class="fa-solid fa-times-circle me-1"></i> Salah</span>
                            @else
                                <span class="badge bg-warning fs-6"><i class="fa-solid fa-hourglass-half me-1"></i> Belum Dinilai</span>
                            @endif
                        </div>

                        <div class="mb-3 p-3 bg-white rounded shadow-sm">
                            <strong>Pertanyaan:</strong>
                            <p class="mb-0 mt-2">{{ $jawaban->ujianSoal->soal->soal_text }}</p>
                        </div>

                        {{-- ESSAY --}}
                        @if($jawaban->ujianSoal->soal->tipe_soal === 'essay')
                            <div class="mb-3">
                                <strong>Jawaban Siswa:</strong>
                                <div class="p-3 bg-light rounded mt-2 border">
                                    {{ $jawaban->jawaban_essay ?? 'Tidak dijawab' }}
                                </div>
                            </div>

                            @if($jawaban->is_benar !== null)
                                {{-- Sudah dinilai --}}
                                <div class="alert alert-success">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">
                                                <i class="fa-solid fa-check-circle me-2"></i> Sudah Dinilai
                                            </h6>
                                            <p class="mb-0">Nilai yang diberikan sudah tersimpan dan tidak dapat diubah.</p>
                                        </div>
                                        <div>
                                            <span class="badge bg-success fs-4 px-4 py-3">
                                                {{ $jawaban->nilai }} / {{ $jawaban->ujianSoal->soal->bobot ?? 5 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Belum dinilai --}}
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">
                                            <i class="fa-solid fa-pen-to-square me-2"></i> Beri Nilai
                                        </h6>
                                        
                                        <form class="form-nilai" data-jawaban-id="{{ $jawaban->id }}">
                                            <div class="row align-items-end">
                                                <div class="col-md-4">
                                                    <label class="form-label">Nilai 
                                                        <small class="text-muted">(Maksimal: {{ $jawaban->ujianSoal->soal->bobot ?? 5 }})</small>
                                                    </label>
                                                    <input type="number" 
                                                        class="form-control form-control-lg nilai-input" 
                                                        min="0" 
                                                        max="{{ $jawaban->ujianSoal->soal->bobot ?? 5 }}"
                                                        step="0.5"
                                                        value="{{ $jawaban->nilai ?? 0 }}"
                                                        required>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-success btn-lg">
                                                        <i class="fa-solid fa-save me-2"></i> Simpan Nilai
                                                    </button>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <small class="text-muted">
                                                        <i class="fa-solid fa-info-circle me-1"></i>
                                                        Nilai hanya bisa disimpan 1 kali
                                                    </small>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif

                        {{-- PILIHAN GANDA --}}
                        @if(in_array($jawaban->ujianSoal->soal->tipe_soal, ['pg', 'pilihan_ganda', 'benar_salah']))
                            <div class="mt-3">
                                <span class="badge bg-primary fs-6">
                                    <i class="fa-solid fa-star me-1"></i>
                                    Nilai: {{ $jawaban->nilai }} / {{ $jawaban->ujianSoal->soal->bobot ?? 5 }}
                                </span>
                            </div>
                        @endif

                    </div>
                @endforeach

            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.form-nilai').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const jawabanId = this.dataset.jawabanId;
                    const nilai = this.querySelector('.nilai-input').value;
                    const btn = this.querySelector('button[type="submit"]');
                    const originalHTML = btn.innerHTML;

                    const formData = new FormData();
                    formData.append('nilai', nilai);
                    formData.append('_token', '{{ csrf_token() }}');

                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Menyimpan...';

                    fetch(`/ujian-siswa/nilai/${jawabanId}`, {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => {
                        if (!res.ok) {
                            return res.json().then(err => { throw err; });
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Tampilkan notifikasi sukses
                            btn.classList.replace('btn-success', 'btn-primary');
                            btn.innerHTML = '<i class="fa-solid fa-check me-2"></i> Tersimpan!';
                            
                            // Reload untuk update nilai total
                            setTimeout(() => {
                                window.location.reload();
                            }, 800);
                        }
                    })
                    .catch(err => {
                        const message = err.message || 'Gagal menyimpan nilai. Silakan coba lagi.';
                        alert('⚠️ ' + message);
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>