<x-app-layout>
    <div class="card shadow-sm p-4">

        <!-- Header Rapor -->
        <div class="text-center mb-4">
            <h4 class="fw-bold text-danger">RAPOR SISWA</h4>
            <p class="mb-1">Semester {{ $semester }} - Tahun Ajaran {{ $tahun_ajaran }}</p>
        </div>

        <hr>

        <!-- Data Siswa -->
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Nama Siswa</strong></td>
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
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Semester</strong></td>
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
        <h5 class="fw-bold text-danger mb-3">Nilai Mata Pelajaran</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Mata Pelajaran</th>
                        <th width="120">Nilai Akhir</th>
                        <th width="80">Huruf</th>
                        <th width="150">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekaps as $rekap)
                        @php
                            $nilai = $rekap->nilai_akhir;
                            if ($nilai >= 90) {
                                $huruf = 'A';
                                $badge = 'bg-success';
                                $ket = 'Sangat Baik';
                            } elseif ($nilai >= 80) {
                                $huruf = 'B';
                                $badge = 'bg-primary';
                                $ket = 'Baik';
                            } elseif ($nilai >= 70) {
                                $huruf = 'C';
                                $badge = 'bg-warning text-dark';
                                $ket = 'Cukup';
                            } elseif ($nilai >= 60) {
                                $huruf = 'D';
                                $badge = 'bg-orange text-white';
                                $ket = 'Kurang';
                            } else {
                                $huruf = 'E';
                                $badge = 'bg-danger';
                                $ket = 'Sangat Kurang';
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
                        <th colspan="2" class="text-end">Rata-rata Keseluruhan:</th>
                        <th class="text-center">
                            <strong class="text-primary fs-5">{{ number_format($rata_rata, 2) }}</strong>
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Keterangan Nilai -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <strong>📖 Keterangan Nilai</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><span class="badge bg-success">A</span> : 90 - 100 (Sangat Baik)</p>
                        <p class="mb-1"><span class="badge bg-primary">B</span> : 80 - 89 (Baik)</p>
                        <p class="mb-0"><span class="badge bg-warning text-dark">C</span> : 70 - 79 (Cukup)</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><span class="badge bg-orange text-white">D</span> : 60 - 69 (Kurang)</p>
                        <p class="mb-0"><span class="badge bg-danger">E</span> : 0 - 59 (Sangat Kurang)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Presensi Section -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <strong>📊 Rekap Kehadiran</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center p-3 border rounded">
                            <h4 class="text-warning">{{ $presensi['izin'] ?? 0 }}</h4>
                            <p class="mb-0">Izin</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 border rounded">
                            <h4 class="text-info">{{ $presensi['sakit'] ?? 0 }}</h4>
                            <p class="mb-0">Sakit</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 border rounded">
                            <h4 class="text-danger">{{ $presensi['alpa'] ?? 0 }}</h4>
                            <p class="mb-0">Tanpa Keterangan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ekstrakurikuler Section -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <strong>🎯 Ekstrakurikuler yang Diikuti</strong>
            </div>
            <div class="card-body">
                @if($ekstrakurikuler->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Pembina</th>
                                    <th>Jadwal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ekstrakurikuler as $index => $ekstra)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $ekstra->nama_extra }}</td>
                                    <td>{{ $ekstra->pembina->user->name }}</td>
                                    <td>{{ $ekstra->jadwal }}</td>
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

        <!-- ============================= TAMBAHKAN BAGIAN PRESTASI ============================= -->
        <!-- Prestasi Section -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <strong>🏆 Prestasi yang Diraih</strong>
            </div>
            <div class="card-body">
                @if($prestasi->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
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
        <!-- ============================= AKHIR BAGIAN YANG DITAMBAHKAN ============================= -->

        <!-- Catatan Perkembangan -->
        <div class="card mt-4">
            <div class="card-header bg-light fw-bold">📝 Catatan Wali Kelas</div>
            <div class="card-body">
                @if($catatan)
                    <p><strong>Akademik:</strong><br>{{ $catatan->catatan_akademik }}</p>
                    <hr>
                    <p><strong>Non Akademik:</strong><br>{{ $catatan->catatan_non_akademik }}</p>

                    <div class="text-end mt-3 text-muted">
                        <small>
                            {{ $catatan->walikelas->guru->user->name }} –
                            {{ $catatan->walikelas->kelas->nama_kelas }}
                        </small>
                    </div>
                @else
                    <em class="text-muted">Belum ada catatan perkembangan</em>
                @endif
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('rapor.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
            <a href="{{ route('rapor.cetak', [$siswa->id, $semester, str_replace('/', '-', $tahun_ajaran)]) }}" 
               class="btn btn-danger" target="_blank">
                <i class="fa-solid fa-file-pdf me-2"></i> Cetak PDF
            </a>
        </div>

    </div>

    <style>
        .bg-orange {
            background-color: #fd7e14;
        }
    </style>
</x-app-layout>