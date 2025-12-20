<x-app-layout>

    <div class="card shadow-sm p-4">

        <!-- Info Siswa -->
        <div class="alert alert-light border mb-4">
            <h5 class="mb-2">👤 {{ $siswa->user->name ?? 'Siswa' }}</h5>
            <p class="mb-1"><strong>NIS:</strong> {{ $siswa->user->username }}</p>
            <p class="mb-0"><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
        </div>

        @if($rekaps->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fa-solid fa-info-circle me-2"></i>
                Belum ada rekap nilai tersedia.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Bobot</th>
                            <th>Rata² Tugas</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Huruf</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($rekaps as $r)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $r->mapel->nama_mapel ?? '-' }}</td>
                                <td class="text-center">{{ $r->semester }}</td>
                                <td class="text-center">{{ $r->tahun_ajaran }}</td>
                                <td class="text-center">
                                    @if($r->pembobotan)
                                        <small class="d-block">T:{{ $r->pembobotan->bobot_tugas }}%</small>
                                        <small class="d-block">UTS:{{ $r->pembobotan->bobot_uts }}%</small>
                                        <small class="d-block">UAS:{{ $r->pembobotan->bobot_uas }}%</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ number_format($r->rata_rata_tugas, 2) }}</td>
                                <td class="text-center">{{ number_format($r->nilai_uts, 2) }}</td>
                                <td class="text-center">{{ number_format($r->nilai_uas, 2) }}</td>
                                <td class="text-center">
                                    <strong class="text-primary">{{ number_format($r->nilai_akhir, 2) }}</strong>
                                </td>
                                <td class="text-center">
                                    @php
                                        $huruf = '';
                                        $badge = '';
                                        if ($r->nilai_akhir >= 90) {
                                            $huruf = 'A';
                                            $badge = 'bg-success';
                                        } elseif ($r->nilai_akhir >= 80) {
                                            $huruf = 'B';
                                            $badge = 'bg-primary';
                                        } elseif ($r->nilai_akhir >= 70) {
                                            $huruf = 'C';
                                            $badge = 'bg-warning text-dark';
                                        } elseif ($r->nilai_akhir >= 60) {
                                            $huruf = 'D';
                                            $badge = 'bg-orange text-white';
                                        } else {
                                            $huruf = 'E';
                                            $badge = 'bg-danger';
                                        }
                                    @endphp
                                    <span class="badge {{ $badge }} px-3 py-2">{{ $huruf }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="table-light">
                        <tr>
                            <th colspan="8" class="text-end">Rata-rata Keseluruhan:</th>
                            <th class="text-center">
                                <strong class="text-primary">{{ number_format($rekaps->avg('nilai_akhir'), 2) }}</strong>
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Keterangan Huruf -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <strong>📖 Keterangan Nilai Huruf</strong>
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
        @endif

    </div>

    <style>
        .bg-orange {
            background-color: #fd7e14;
        }
    </style>
</x-app-layout>
