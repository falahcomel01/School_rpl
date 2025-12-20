<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- ================= ALERT ================= --}}
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


            {{-- =========================================================
                 🟢 HASIL FINAL (HANYA JIKA DISETUJUI)
            ========================================================== --}}
            @if($rekomendasi && $rekomendasi->validasi === 'disetujui')
                <div class="card modern-card shadow-lg border-0 mb-4">
                    <div class="card-header gradient-success text-white py-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Hasil Penjurusan (Final)
                            </h4>
                            <div class="badge bg-white text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i>Disetujui
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Pilihan Awal -->
                            <div class="col-md-6">
                                <div class="info-card card-initial">
                                    <div class="info-header">
                                        <i class="fas fa-hand-paper"></i>
                                        <span>Pilihan Awal Anda</span>
                                    </div>
                                    <h4 class="info-value">
                                        {{ $rekomendasi->jurusan->nama_jurusan }}
                                    </h4>
                                </div>
                            </div>

                            <!-- Rekomendasi Wali -->
                            <div class="col-md-6">
                                <div class="info-card card-final">
                                    <div class="info-header">
                                        <i class="fas fa-star"></i>
                                        <span>Hasil Rekomendasi</span>
                                    </div>
                                    <h4 class="info-value">
                                        {{ $rekomendasi->rekomendasiJurusan ? $rekomendasi->rekomendasiJurusan->nama_jurusan : $rekomendasi->jurusan->nama_jurusan }}
                                    </h4>
                                    @if($rekomendasi->jurusan_rekomendasi_id && $rekomendasi->jurusan_id !== $rekomendasi->jurusan_rekomendasi_id)
                                        <div class="badge badge-warning mt-2">
                                            <i class="fas fa-info-circle me-1"></i>Berbeda dari pilihan awal
                                        </div>
                                    @elseif($rekomendasi->jurusan_rekomendasi_id)
                                        <div class="badge badge-match mt-2">
                                            <i class="fas fa-check me-1"></i>Sesuai pilihan Anda
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($rekomendasi->catatan_wali_kelas)
                            <div class="catatan-box mt-4">
                                <div class="catatan-header">
                                    <i class="fas fa-comment-dots"></i>
                                    <strong>Catatan Wali Kelas</strong>
                                </div>
                                <p class="mb-0">{{ $rekomendasi->catatan_wali_kelas }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif


            {{-- =========================================================
                 🔴 STATUS PENDING (MENUNGGU VALIDASI)
            ========================================================== --}}
            @if($rekomendasi && $rekomendasi->validasi === 'pending')
                <div class="card modern-card shadow-lg border-0 mb-4">
                    <div class="card-header gradient-danger text-white py-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-hourglass-half me-2"></i>
                                Pilihan Jurusan
                            </h4>
                            <div class="badge bg-warning text-dark px-3 py-2">
                                <i class="fas fa-clock me-1"></i>Menunggu Validasi
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="pending-card">
                            <div class="pending-icon">
                                <i class="fas fa-bookmark"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-2">Jurusan yang Anda pilih:</p>
                                <h3 class="fw-bold mb-0">
                                    {{ $rekomendasi->jurusan->nama_jurusan }}
                                </h3>
                            </div>
                        </div>

                        <div class="info-box info-warning mt-4">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>Menunggu Validasi</strong>
                                <p class="mb-0 small">Pilihan Anda sedang ditinjau oleh wali kelas. Anda akan mendapat notifikasi hasil validasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            {{-- =========================================================
                 🟡 STATUS DITOLAK
            ========================================================== --}}
            @if($rekomendasi && $rekomendasi->validasi === 'ditolak')
                <div class="card modern-card shadow-lg border-0 mb-4">
                    <div class="card-header bg-secondary text-white py-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-times-circle me-2"></i>
                                Pilihan Sebelumnya
                            </h4>
                            <div class="badge bg-white text-secondary px-3 py-2">
                                <i class="fas fa-times me-1"></i>Ditolak
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="rejected-card">
                            <div class="rejected-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-2">Pilihan jurusan sebelumnya:</p>
                                <h4 class="fw-bold mb-3">
                                    {{ $rekomendasi->jurusan->nama_jurusan }}
                                </h4>
                            </div>
                        </div>

                        @if($rekomendasi->catatan_wali_kelas)
                            <div class="catatan-box catatan-danger">
                                <div class="catatan-header">
                                    <i class="fas fa-comment-dots"></i>
                                    <strong>Alasan Penolakan</strong>
                                </div>
                                <p class="mb-0">{{ $rekomendasi->catatan_wali_kelas }}</p>
                            </div>
                        @endif

                        <div class="info-box info-danger mt-3">
                            <i class="fas fa-redo"></i>
                            <div>
                                <strong>Silakan Pilih Jurusan Lain</strong>
                                <p class="mb-0 small">Pilihan Anda sebelumnya ditolak. Silakan pilih jurusan lain di bawah ini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            {{-- =========================================================
                 🔵 FORM PILIH JURUSAN
            ========================================================== --}}
            @if(!$rekomendasi || $rekomendasi->validasi === 'ditolak')
                <div class="card modern-card shadow-lg border-0">
                    <div class="card-header gradient-danger text-white py-4">
                        <div class="text-center">
                            <div class="header-icon mb-2">
                                <i class="fas fa-compass"></i>
                            </div>
                            <h4 class="mb-1 fw-bold">Pilih Jurusan yang Anda Minati</h4>
                            <p class="mb-0 small opacity-90">Pilihan akan diteruskan ke wali kelas untuk validasi</p>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('rekomendasi.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">
                                    <i class="fas fa-bookmark me-2 text-danger"></i>Jurusan Pilihan
                                </label>

                                <select name="jurusan_id" class="form-select modern-select form-select-lg" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j->id }}">
                                            {{ $j->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>

                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Pilih jurusan yang sesuai dengan minat dan kemampuan Anda
                                </small>
                            </div>

                            <button type="submit" class="btn btn-danger btn-lg w-100 modern-btn">
                                <i class="fas fa-paper-plane me-2"></i>
                                Simpan Pilihan Jurusan
                            </button>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        .modern-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.15)!important;
        }

        .gradient-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .gradient-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        .modern-alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
        }

        .header-icon {
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 2px solid #e5e7eb;
            height: 100%;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card-initial {
            border-color: #dbeafe;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }

        .card-final {
            border-color: #d1fae5;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .info-header i {
            font-size: 16px;
        }

        .card-initial .info-header {
            color: #1e40af;
        }

        .card-final .info-header {
            color: #065f46;
        }

        .info-value {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .card-initial .info-value {
            color: #1e40af;
        }

        .card-final .info-value {
            color: #065f46;
        }

        .badge-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-match {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .catatan-box {
            background: white;
            border-left: 4px solid #3b82f6;
            border-radius: 10px;
            padding: 16px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .catatan-danger {
            border-left-color: #dc2626;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        .catatan-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #1e40af;
        }

        .catatan-danger .catatan-header {
            color: #991b1b;
        }

        .catatan-header i {
            font-size: 18px;
        }

        .pending-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .pending-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            flex-shrink: 0;
        }

        .rejected-card {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .rejected-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            flex-shrink: 0;
        }

        .info-box {
            border-radius: 10px;
            padding: 16px;
            display: flex;
            gap: 12px;
            align-items: start;
        }

        .info-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 2px solid #fcd34d;
        }

        .info-warning i {
            color: #d97706;
            font-size: 20px;
            margin-top: 2px;
        }

        .info-warning strong {
            color: #92400e;
        }

        .info-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #fca5a5;
        }

        .info-danger i {
            color: #dc2626;
            font-size: 20px;
            margin-top: 2px;
        }

        .info-danger strong {
            color: #991b1b;
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

        .modern-btn {
            border-radius: 10px;
            padding: 14px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .modern-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.3);
        }

        @media (max-width: 768px) {
            .pending-card, .rejected-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</x-app-layout>