<x-app-layout>
    <x-slot name="header">
        <div class="elite-page-header">
            <h1 class="elite-page-title">
                📝 {{ $ujianSiswa->ujian->jenis_ujian }}
                @if($ujianSiswa->paket)
                    <span class="elite-badge elite-badge-paket ms-2">Paket {{ $ujianSiswa->paket }}</span>
                @endif
            </h1>
            <p class="elite-page-subtitle">
                {{ $ujianSiswa->ujian->kelas->nama_kelas ?? 'Kelas Tidak Diketahui' }}
            </p>
        </div>
    </x-slot>

    <div class="elite-container">

        {{-- Timer di atas konten (bukan di header) --}}
        <div class="elite-timer-card mb-4">
            <div class="elite-timer-content">
                <small class="elite-timer-label">Sisa Waktu</small>
                <h3 id="timer" class="elite-timer-value">--:--</h3>
            </div>
        </div>

        {{-- ALERT INFO --}}
        <div class="elite-alert elite-alert-info mb-4">
            <i class="fa-solid fa-circle-info me-2"></i>
            Jawaban otomatis tersimpan. Gunakan tombol atau nomor soal untuk navigasi.
        </div>

        {{-- NOMOR SOAL --}}
        <div class="elite-card mb-4">
            <div class="elite-card-body">
                <h6 class="elite-section-title mb-3">📋 Daftar Soal</h6>

                <div class="soal-nav-container">
                    @foreach($ujianSiswa->jawabanSiswas as $index => $jawaban)
                        <button
                            type="button"
                            class="btn-soal {{ $index === 0 ? 'active' : '' }}"
                            data-soal-index="{{ $index }}"
                            data-jawaban-id="{{ $jawaban->id }}"
                            data-status="{{ $jawaban->opsi_jawaban_id || trim($jawaban->jawaban_essay) ? 'dijawab' : 'kosong' }}"
                        >
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>

                <div class="mt-3 d-flex flex-wrap gap-3">
                    <small>
                        <span class="legend legend-active"></span> Soal Aktif
                    </small>
                    <small>
                        <span class="legend legend-answered"></span> Sudah Dijawab
                    </small>
                    <small>
                        <span class="legend legend-empty"></span> Belum Dijawab
                    </small>
                </div>
            </div>
        </div>

        {{-- SOAL --}}
        <div class="elite-card">
            <div class="elite-card-body">

                @foreach($ujianSiswa->jawabanSiswas as $index => $jawaban)
                    <div class="soal-container" data-soal-index="{{ $index }}" style="{{ $index === 0 ? '' : 'display:none;' }}">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="elite-soal-title">Soal {{ $index + 1 }} dari {{ $ujianSiswa->jawabanSiswas->count() }}</h2>
                            <span class="elite-badge elite-badge-type">
                                {{ Str::title(str_replace('_', ' ', $jawaban->ujianSoal->soal->tipe_soal)) }}
                            </span>
                        </div>

                        <div class="soal-box mb-4">
                            {!! nl2br(e($jawaban->ujianSoal->soal->soal_text)) !!}
                        </div>

                        {{-- PILIHAN GANDA --}}
                        @if(in_array($jawaban->ujianSoal->soal->tipe_soal, ['pg', 'benar_salah']))
                            @foreach($jawaban->ujianSoal->soal->opsiJawaban as $opsi)
                                <div class="form-check mb-2">
                                    <input
                                        class="form-check-input jawaban-radio"
                                        type="radio"
                                        name="jawaban_{{ $jawaban->id }}"
                                        id="opsi_{{ $opsi->id }}"
                                        value="{{ $opsi->id }}"
                                        data-jawaban-id="{{ $jawaban->id }}"
                                        {{ $jawaban->opsi_jawaban_id == $opsi->id ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="opsi_{{ $opsi->id }}">
                                        <strong>{{ $opsi->urutan }}.</strong> {{ $opsi->opsi_text }}
                                    </label>
                                </div>
                            @endforeach

                        {{-- ESSAY --}}
                        @elseif($jawaban->ujianSoal->soal->tipe_soal === 'essay')
                            <textarea
                                class="form-control jawaban-essay"
                                rows="5"
                                data-jawaban-id="{{ $jawaban->id }}"
                                placeholder="Tulis jawaban Anda di sini..."
                            >{{ $jawaban->jawaban_essay }}</textarea>
                            <small class="text-muted mt-1 d-block">Disimpan otomatis...</small>
                        @endif
                    </div>
                @endforeach

                {{-- NAVIGASI --}}
                <hr class="my-4">
                <div class="d-flex justify-content-between mt-3">
                    <button id="btn-prev" class="elite-btn elite-btn-outline" disabled>
                        <i class="fa-solid fa-arrow-left me-1"></i> Sebelumnya
                    </button>

                    <button id="btn-selesai" class="elite-btn elite-btn-danger" style="display:none;">
                        <i class="fa-solid fa-check me-1"></i> Kumpulkan Ujian
                    </button>

                    <button id="btn-next" class="elite-btn elite-btn-primary">
                        Selanjutnya <i class="fa-solid fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>

        <form id="form-kumpul-ujian" method="POST" action="{{ route('ujian_siswa.selesai', $ujianSiswa->id) }}" style="display:none;">
            @csrf
        </form>
    </div>

    @push('styles')
    <style>
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #2d3748;
        }

        /* Header Halaman */
        .elite-page-header {
            padding-bottom: 16px;
            border-bottom: 1px solid #eee;
            margin-bottom: 24px;
        }
        .elite-page-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #b91c1c;
            margin: 0;
        }
        .elite-page-subtitle {
            color: #64748b;
            margin: 4px 0 0;
            font-size: 14px;
        }

        .elite-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px 40px;
        }

        /* Timer di Atas Konten */
        .elite-timer-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            border: 1px solid #f1f1f1;
            max-width: 200px;
            margin-left: auto;
        }
        .elite-timer-content {
            text-align: center;
        }
        .elite-timer-label {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 4px;
        }
        .elite-timer-value {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 700;
            color: #b91c1c;
        }
        .elite-timer-value .text-danger {
            color: #dc2626 !important;
        }

        /* Alert */
        .elite-alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .elite-alert-info {
            background-color: #e6f0ff;
            border-left: 4px solid #1a73e8;
            color: #174ea6;
        }

        /* Card */
        .elite-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border: 1px solid #eee;
            overflow: hidden;
        }
        .elite-card-body {
            padding: 24px;
        }

        /* Judul & Badge */
        .elite-section-title {
            font-weight: 700;
            color: #b91c1c;
            font-size: 1.1rem;
            margin: 0;
        }
        .elite-soal-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .elite-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }
        .elite-badge-paket {
            background: #fde8e8;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .elite-badge-type {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Soal Box */
        .soal-box {
            background: #f9fafb;
            padding: 16px;
            border-radius: 10px;
            font-size: 1.05rem;
            line-height: 1.6;
            border-left: 3px solid #b91c1c;
        }

        /* Tombol Nomor Soal */
        .soal-nav-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(40px, 1fr));
            gap: 6px;
        }
        .btn-soal {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            border: 2px solid #e2e8f0;
            background: white;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-soal:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-soal.active {
            background: #b91c1c !important;
            color: #fff !important;
            border-color: #b91c1c !important;
        }
        .btn-soal[data-status="dijawab"]:not(.active) {
            background: #dcfce7 !important;
            color: #166534;
            border-color: #bbf7d0;
        }
        .btn-soal[data-status="kosong"]:not(.active) {
            background: #f1f5f9 !important;
            color: #64748b;
            border-color: #cbd5e1;
        }

        /* Legend */
        .legend {
            width: 12px;
            height: 12px;
            display: inline-block;
            border-radius: 3px;
            vertical-align: middle;
            margin-right: 4px;
        }
        .legend-active { background: #b91c1c; }
        .legend-answered { background: #16a34a; }
        .legend-empty { background: #94a3b8; }

        /* Tombol Navigasi */
        .elite-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            border: 1px solid transparent;
        }
        .elite-btn-primary {
            background-color: #b91c1c;
            color: white;
        }
        .elite-btn-primary:hover {
            background-color: #991b1b;
        }
        .elite-btn-danger {
            background-color: #dc2626;
            color: white;
        }
        .elite-btn-danger:hover {
            background-color: #b91b1b;
        }
        .elite-btn-outline {
            background-color: #f8fafc;
            color: #475569;
            border-color: #cbd5e1;
        }
        .elite-btn-outline:hover {
            background-color: #f1f5f9;
        }
        .elite-btn-outline:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Form Control */
        .form-check-input {
            accent-color: #b91c1c;
        }
        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px 12px;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .elite-container {
                padding: 0 12px 32px;
            }
            .soal-nav-container {
                grid-template-columns: repeat(auto-fill, minmax(34px, 1fr));
            }
            .btn-soal {
                width: 34px;
                height: 34px;
                font-size: 0.85rem;
            }
            .elite-timer-card {
                max-width: 160px;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // (Script tetap sama seperti aslinya — tidak diubah)
        document.addEventListener('DOMContentLoaded', function () {
            const totalSoal = {{ $ujianSiswa->jawabanSiswas->count() }};
            let current = 0;

            const btnPrev = document.getElementById('btn-prev');
            const btnNext = document.getElementById('btn-next');
            const btnSelesai = document.getElementById('btn-selesai');
            const containers = document.querySelectorAll('.soal-container');
            const nomorBtns = document.querySelectorAll('.btn-soal');

            function showSoal(i) {
                containers.forEach((el, idx) => el.style.display = idx === i ? 'block' : 'none');
                nomorBtns.forEach((btn, idx) => btn.classList.toggle('active', idx === i));
                current = i;

                btnPrev.disabled = (i === 0);
                btnNext.style.display = i === totalSoal - 1 ? 'none' : 'inline-block';
                btnSelesai.style.display = i === totalSoal - 1 ? 'inline-block' : 'none';
            }

            btnPrev.onclick = () => current > 0 && showSoal(current - 1);
            btnNext.onclick = () => current < totalSoal - 1 && showSoal(current + 1);
            nomorBtns.forEach((btn, i) => btn.onclick = () => showSoal(i));

            btnSelesai.onclick = () => {
                if (confirm("Yakin ingin mengumpulkan ujian sekarang?")) {
                    document.getElementById('form-kumpul-ujian').submit();
                }
            };

            /* AUTO SAVE */
            function updateJawaban(id, opsi = null, essay = null) {
                fetch(`/ujian_siswa/{{ $ujianSiswa->id }}/jawaban/${id}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        opsi_jawaban_id: opsi,
                        jawaban_essay: essay
                    })
                })
                .then(r => r.json())
                .then(() => {
                    const btn = document.querySelector(`.btn-soal[data-jawaban-id="${id}"]`);
                    if (btn) {
                        btn.dataset.status = opsi || (essay && essay.trim()) ? "dijawab" : "kosong";
                    }
                })
                .catch(err => console.error('Gagal menyimpan:', err));
            }

            document.querySelectorAll('.jawaban-radio').forEach(r => {
                r.onchange = () => updateJawaban(r.dataset.jawabanId, r.value, null);
            });

            document.querySelectorAll('.jawaban-essay').forEach(t => {
                let tm;
                t.oninput = () => {
                    clearTimeout(tm);
                    tm = setTimeout(() => updateJawaban(t.dataset.jawabanId, null, t.value), 700);
                };
            });

            /* TIMER */
            const timerEl = document.getElementById("timer");
            let shown = false;
            let submitted = false;

            const mulai = new Date("{{ $waktuMulaiIso }}");
            const durasi = {{ $ujianSiswa->ujian->durasi_menit }};
            const selesai = new Date(mulai.getTime() + durasi * 60000);

            function tick() {
                const now = new Date();
                const diff = Math.floor((selesai - now) / 1000);

                if (diff <= 0) {
                    clearInterval(interval);
                    if (!shown && !submitted) {
                        shown = true;
                        submitted = true;
                        alert("⏰ Waktu habis! Ujian dikumpulkan otomatis.");
                        document.getElementById('form-kumpul-ujian').submit();
                    }
                    return;
                }

                const m = String(Math.floor(diff / 60)).padStart(2, "0");
                const s = String(diff % 60).padStart(2, "0");
                let timerClass = diff < 300 ? "text-danger fw-bold" : "";

                timerEl.innerHTML = `<span class="${timerClass}">${m}:${s}</span>`;
            }

            tick();
            const interval = setInterval(tick, 1000);

            showSoal(0);
        });
    </script>
    @endpush
</x-app-layout>