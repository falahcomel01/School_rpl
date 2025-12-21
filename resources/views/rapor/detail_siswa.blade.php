<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm rounded-3 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header Rapor -->
            <div class="text-center mb-4">
                <h4 class="fw-bold text-danger">RAPOR SISWA</h4>
                <p class="text-muted mb-0">Semester {{ $semester }} – Tahun Ajaran {{ $tahun_ajaran }}</p>
            </div>
            <hr class="mb-4">

            <!-- Data Siswa -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted fw-bold"><i class="fas fa-user me-2"></i>Data Siswa</h6>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="140"><strong>Nama</strong></td>
                            <td>: {{ $siswa->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIS</strong></td>
                            <td>: {{ $siswa->user->username ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kelas</strong></td>
                            <td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td>: {{ $siswa->kelas->jurusan->nama_jurusan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted fw-bold"><i class="fas fa-graduation-cap me-2"></i>Informasi Akademik</h6>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="140"><strong>Semester</strong></td>
                            <td>: {{ $semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td>: {{ $tahun_ajaran }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Mapel</strong></td>
                            <td>: {{ $rekaps->count() }} mata pelajaran</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Nilai Per Mapel -->
            <h5 class="fw-bold text-danger mb-3"><i class="fas fa-book me-2"></i>Nilai Mata Pelajaran</h5>
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-danger text-center">
                        <tr>
                            <th width="40">No</th>
                            <th>Mata Pelajaran</th>
                            <th width="110">Nilai Akhir</th>
                            <th width="70">Huruf</th>
                            <th width="150">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekaps as $rekap)
                            @php
                                $nilai = $rekap->nilai_akhir;
                                if ($nilai >= 90) {
                                    $huruf = 'A'; $badge = 'bg-success'; $ket = 'Sangat Baik';
                                } elseif ($nilai >= 80) {
                                    $huruf = 'B'; $badge = 'bg-primary'; $ket = 'Baik';
                                } elseif ($nilai >= 70) {
                                    $huruf = 'C'; $badge = 'bg-warning text-dark'; $ket = 'Cukup';
                                } elseif ($nilai >= 60) {
                                    $huruf = 'D'; $badge = 'bg-orange text-white'; $ket = 'Kurang';
                                } else {
                                    $huruf = 'E'; $badge = 'bg-danger'; $ket = 'Sangat Kurang';
                                }
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $rekap->mapel->nama_mapel ?? '-' }}</td>
                                <td class="text-center">
                                    <strong class="text-primary">{{ number_format($rekap->nilai_akhir, 2) }}</strong>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $badge }} px-3 py-2">{{ $huruf }}</span>
                                </td>
                                <td class="text-center">{{ $ket }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="2" class="text-end fw-bold">Rata-rata Keseluruhan:</th>
                            <th class="text-center">
                                <strong class="text-primary fs-5">{{ number_format($rata_rata, 2) }}</strong>
                            </th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Keterangan Nilai -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light py-2">
                    <strong><i class="fas fa-info-circle me-2"></i>Keterangan Nilai</strong>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span><span class="badge bg-success me-1">A</span> 90–100 (Sangat Baik)</span>
                        <span><span class="badge bg-primary me-1">B</span> 80–89 (Baik)</span>
                        <span><span class="badge bg-warning text-dark me-1">C</span> 70–79 (Cukup)</span>
                        <span><span class="badge bg-orange text-white me-1">D</span> 60–69 (Kurang)</span>
                        <span><span class="badge bg-danger me-1">E</span> 0–59 (Sangat Kurang)</span>
                    </div>
                </div>
            </div>

            <!-- Presensi Section -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light py-2">
                    <strong><i class="fas fa-calendar-check me-2"></i>Rekap Kehadiran</strong>
                </div>
                <div class="card-body">
                    <div class="row text-center g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-2 border">
                                <i class="fas fa-check-circle text-warning fs-3 d-block mb-2"></i>
                                <h5 class="text-warning mb-1">{{ $presensi['izin'] ?? 0 }}</h5>
                                <p class="mb-0 text-muted">Izin</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-2 border">
                                <i class="fas fa-user-md text-info fs-3 d-block mb-2"></i>
                                <h5 class="text-info mb-1">{{ $presensi['sakit'] ?? 0 }}</h5>
                                <p class="mb-0 text-muted">Sakit</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-2 border">
                                <i class="fas fa-exclamation-triangle text-danger fs-3 d-block mb-2"></i>
                                <h5 class="text-danger mb-1">{{ $presensi['alpa'] ?? 0 }}</h5>
                                <p class="mb-0 text-muted">Tanpa Keterangan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ekstrakurikuler Section -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light py-2">
                    <strong><i class="fas fa-running me-2"></i>Ekstrakurikuler yang Diikuti</strong>
                </div>
                <div class="card-body">
                    @if($ekstrakurikuler->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="40">No</th>
                                        <th>Nama Ekstrakurikuler</th>
                                        <th>Pembina</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ekstrakurikuler as $index => $ekstra)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $ekstra->nama_extra }}</td>
                                        <td>{{ $ekstra->pembina->user->name ?? '-' }}</td>
                                        <td>{{ $ekstra->deskripsi ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0 fst-italic">Siswa tidak mengikuti ekstrakurikuler.</p>
                    @endif
                </div>
            </div>

            <!-- Prestasi Section -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light py-2">
                    <strong><i class="fas fa-trophy text-warning me-2"></i>Prestasi yang Diraih</strong>
                </div>
                <div class="card-body">
                    @if($prestasi->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="40">No</th>
                                        <th>Nama Prestasi</th>
                                        <th>Jenis</th>
                                        <th>Tingkat</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prestasi as $index => $prest)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $prest->nama_prestasi }}</td>
                                        <td>{{ $prest->jenis }}</td>
                                        <td>{{ $prest->tingkat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($prest->tanggal)->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0 fst-italic">Belum ada prestasi yang dicatat untuk semester ini.</p>
                    @endif
                </div>
            </div>

            <!-- Catatan Perkembangan -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light py-2 fw-bold">
                    <i class="fas fa-sticky-note me-2"></i>Catatan Wali Kelas
                </div>
                <div class="card-body">
                    @if($catatan)
                        <p><strong>Akademik:</strong><br>{{ $catatan->catatan_akademik }}</p>
                        <hr>
                        <p><strong>Non Akademik:</strong><br>{{ $catatan->catatan_non_akademik }}</p>
                        <div class="text-end mt-3 text-muted fst-italic">
                            <small>
                                Oleh: {{ $catatan->walikelas->guru->user->name ?? '-' }}<br>
                                Wali Kelas {{ $catatan->walikelas->kelas->nama_kelas ?? '-' }}
                            </small>
                        </div>
                    @else
                        <em class="text-muted">Belum ada catatan perkembangan.</em>
                    @endif
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex flex-wrap gap-2 justify-content-between mt-4">
                <a href="{{ route('rapor.siswa') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
                <a href="{{ route('rapor.cetak_siswa', [$semester, str_replace('/', '-', $tahun_ajaran)]) }}" 
                   class="btn btn-danger" target="_blank">
                    <i class="fa-solid fa-file-pdf me-2"></i> Cetak PDF
                </a>
            </div>

        </div>
    </div>

    <style>
        .bg-orange {
            background-color: #fd7e14 !important;
        }
        .card-header {
            font-weight: 600;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</x-app-layout>