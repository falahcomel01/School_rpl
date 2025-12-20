<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm text-center p-5">

                    {{-- ======================
                        BELUM ADA DATA
                    ====================== --}}
                    @if(!$rekomendasi)
                        <i class="fas fa-info-circle fa-4x text-secondary mb-3"></i>
                        <h4 class="fw-bold">Belum Ada Pilihan Jurusan</h4>
                        <p class="text-muted">
                            Anda belum mengajukan pilihan jurusan.
                        </p>
                        <a href="{{ route('rekomendasi.index') }}" class="btn btn-primary mt-3">
                            Pilih Jurusan
                        </a>

                    {{-- ======================
                        PENDING
                    ====================== --}}
                    @elseif($rekomendasi->validasi === 'pending')
                        <i class="fas fa-clock fa-4x text-warning mb-3"></i>
                        <h4 class="fw-bold">Sedang Dalam Proses Validasi</h4>
                        <p class="text-muted">
                            Jurusan pilihan Anda:
                            <strong>{{ $rekomendasi->jurusan->nama_jurusan }}</strong>
                        </p>
                        <p class="text-muted">
                            Menunggu persetujuan wali kelas.
                        </p>

                    {{-- ======================
                        DITOLAK
                    ====================== --}}
                    @elseif($rekomendasi->validasi === 'ditolak')
                        <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>
                        <h4 class="fw-bold">Rekomendasi Ditolak</h4>
                        <p class="text-muted">
                            Jurusan yang Anda ajukan:
                            <strong>{{ $rekomendasi->jurusan->nama_jurusan }}</strong>
                        </p>

                        @if($rekomendasi->catatan_wali_kelas)
                            <div class="alert alert-danger mt-3">
                                <strong>Catatan Wali Kelas:</strong><br>
                                {{ $rekomendasi->catatan_wali_kelas }}
                            </div>
                        @endif

                        <a href="{{ route('rekomendasi.index') }}" class="btn btn-danger mt-3">
                            Ajukan Ulang Jurusan
                        </a>

                    {{-- ======================
                        DISETUJUI (FINAL)
                    ====================== --}}
                    @elseif($rekomendasi->validasi === 'disetujui')
                        <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                        <h4 class="fw-bold">Hasil Jurusan Final</h4>

                        <h2 class="text-success fw-bold my-3">
                            {{ $rekomendasi->jurusanRekomendasi->nama_jurusan }}
                        </h2>

                        <p class="text-muted">
                            Telah disetujui oleh wali kelas
                            pada {{ $rekomendasi->updated_at->format('d/m/Y') }}
                        </p>

                        <div class="alert alert-success mt-4">
                            Keputusan ini bersifat <strong>final</strong> dan tidak dapat diubah.
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
