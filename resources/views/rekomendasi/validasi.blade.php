<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 modern-alert" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fs-4 me-3"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 modern-alert" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fs-4 me-3"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 modern-card">
                <div class="card-header gradient-danger text-white py-4">
                    <div class="d-flex align-items-center">
                        <div class="header-icon-small me-3">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Validasi Rekomendasi Jurusan</h5>
                            <small class="opacity-90">{{ $rekomendasi->siswa->user->name }}</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">

                    {{-- RINGKASAN NILAI --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-chart-bar me-2 text-danger"></i>Ringkasan Nilai Akademik
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="nilai-card nilai-ipa">
                                    <i class="fas fa-flask"></i>
                                    <div>
                                        <span>IPA</span>
                                        <strong>{{ number_format($rekomendasi->nilai_ipa, 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="nilai-card nilai-ips">
                                    <i class="fas fa-globe"></i>
                                    <div>
                                        <span>IPS</span>
                                        <strong>{{ number_format($rekomendasi->nilai_ips, 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="nilai-card nilai-bahasa">
                                    <i class="fas fa-book"></i>
                                    <div>
                                        <span>Bahasa</span>
                                        <strong>{{ number_format($rekomendasi->nilai_bahasa, 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INFO PILIHAN SISWA --}}
                    @if($rekomendasi->jurusan)
                        <div class="info-box mb-4">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Pilihan Siswa</h6>
                                <p class="mb-0">Siswa memilih jurusan <strong>{{ $rekomendasi->jurusan->nama_jurusan }}</strong></p>
                            </div>
                        </div>
                    @endif

                    <hr class="my-4">

                    <form action="{{ route('rekomendasi.prosesValidasi', $rekomendasi->id) }}" method="POST">
                        @csrf

                        {{-- JURUSAN REKOMENDASI --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2">
                                <i class="fas fa-pencil-alt me-2 text-danger"></i>Jurusan Rekomendasi
                            </label>
                            <select name="jurusan_rekomendasi_id" class="form-select modern-select form-select-lg" required>
                                <option value="">-- Pilih Jurusan Rekomendasi --</option>
                                @foreach($jurusans as $j)
                                    <option value="{{ $j->id }}"
                                        {{ (string) old('jurusan_rekomendasi_id', $rekomendasi->jurusan_rekomendasi_id) === (string) $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jurusan_rekomendasi_id')
                                <div class="text-danger mt-2 small">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-lightbulb me-1"></i>
                                Pilih jurusan yang sesuai dengan nilai akademik siswa
                            </small>
                        </div>

                        {{-- STATUS VALIDASI --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">
                                <i class="fas fa-tasks text-danger me-2"></i>Hasil Validasi
                            </label>

                            <div class="validation-card mb-3" onclick="selectRadio('disetujui')">
                                <input class="form-check-input" type="radio" name="validasi" id="disetujui" 
                                    value="disetujui"
                                    {{ old('validasi', $rekomendasi->validasi) === 'disetujui' ? 'checked' : '' }}
                                    required>
                                <label class="validation-label" for="disetujui">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-success">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Disetujui</h6>
                                            <small class="text-muted">Siswa diterima di jurusan yang direkomendasikan</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="validation-card" onclick="selectRadio('ditolak')">
                                <input class="form-check-input" type="radio" name="validasi" id="ditolak" 
                                    value="ditolak"
                                    {{ old('validasi', $rekomendasi->validasi) === 'ditolak' ? 'checked' : '' }}
                                    required>
                                <label class="validation-label" for="ditolak">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-danger">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Ditolak</h6>
                                            <small class="text-muted">Siswa perlu memilih jurusan lain</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            @error('validasi')
                                <div class="text-danger mt-2 small">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CATATAN --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2">
                                <i class="fas fa-comment-dots text-danger me-2"></i>Catatan Wali Kelas
                            </label>
                            <textarea name="catatan_wali_kelas" rows="4" class="form-control modern-textarea" 
                                placeholder="Tulis catatan atau alasan validasi untuk siswa...">{{ old('catatan_wali_kelas', $rekomendasi->catatan_wali_kelas) }}</textarea>
                            @error('catatan_wali_kelas')
                                <div class="text-danger mt-2 small">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg btn-success modern-btn">
                                <i class="fas fa-save me-2"></i>Simpan Validasi
                            </button>
                            <a href="{{ route('rekomendasi.daftar') }}" class="btn btn-lg btn-outline-secondary modern-btn">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modern-card {
            border-radius: 16px;
            overflow: hidden;
        }

        .gradient-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        .modern-alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
        }

        .header-icon-small {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .nilai-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .nilai-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .nilai-card i {
            font-size: 32px;
        }

        .nilai-card div {
            display: flex;
            flex-direction: column;
        }

        .nilai-card span {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nilai-card strong {
            font-size: 28px;
            font-weight: 700;
        }

        .nilai-ipa {
            border-color: #fee2e2;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }
        .nilai-ipa i { color: #dc2626; }
        .nilai-ipa span { color: #991b1b; }
        .nilai-ipa strong { color: #dc2626; }

        .nilai-ips {
            border-color: #fef3c7;
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        }
        .nilai-ips i { color: #f59e0b; }
        .nilai-ips span { color: #d97706; }
        .nilai-ips strong { color: #f59e0b; }

        .nilai-bahasa {
            border-color: #dbeafe;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }
        .nilai-bahasa i { color: #3b82f6; }
        .nilai-bahasa span { color: #1e40af; }
        .nilai-bahasa strong { color: #3b82f6; }

        .info-box {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 10px;
            display: flex;
            gap: 12px;
            align-items: start;
        }

        .info-box i {
            color: #1e40af;
            font-size: 20px;
            margin-top: 2px;
        }

        .info-box h6 {
            color: #1e40af;
        }

        .modern-select {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .modern-select:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .validation-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            background: white;
        }

        .validation-card:hover {
            border-color: #dc2626;
            background: #fef2f2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .validation-card input[type="radio"] {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .validation-card:has(input:checked) {
            border-color: #10b981;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.2);
        }

        .validation-label {
            cursor: pointer;
            margin: 0;
            padding-right: 40px;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            font-size: 20px;
        }

        .icon-box.bg-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .icon-box.bg-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        .modern-textarea {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .modern-textarea:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .modern-btn {
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .modern-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        @media (max-width: 768px) {
            .nilai-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        function selectRadio(id) {
            document.getElementById(id).checked = true;
        }
    </script>
</x-app-layout>