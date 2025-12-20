<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rapor {{ $siswa->user->name ?? 'Siswa' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #b91c1c;
        }
        .header h2 {
            font-size: 14px;
            font-weight: normal;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
        }
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-table .label {
            width: 150px;
            font-weight: bold;
        }
        .nilai-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .nilai-table th, .nilai-table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        .nilai-table th {
            background-color: #b91c1c;
            color: white;
            font-weight: bold;
        }
        .nilai-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .nilai-table .mapel {
            text-align: left;
        }
        .rata-rata {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
            margin-bottom: 20px;
        }
        .presensi-section {
            margin-bottom: 20px;
        }
        .presensi-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #b91c1c;
        }
        .presensi-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .presensi-table th, .presensi-table td {
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
        }
        .presensi-table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .ekstrakurikuler-section {
            margin-bottom: 20px;
        }
        .ekstrakurikuler-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #b91c1c;
        }
        .ekstrakurikuler-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .ekstrakurikuler-table th, .ekstrakurikuler-table td {
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
        }
        .ekstrakurikuler-table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .ekstrakurikuler-table .nama {
            text-align: left;
        }
        /* ============================= TAMBAHKAN CSS UNTUK PRESTASI ============================= */
        .prestasi-section {
            margin-bottom: 20px;
        }
        .prestasi-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #b91c1c;
        }
        .prestasi-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .prestasi-table th, .prestasi-table td {
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
        }
        .prestasi-table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .prestasi-table .nama {
            text-align: left;
        }
        /* ============================= AKHIR CSS YANG DITAMBAHKAN ============================= */
        .catatan-section {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .catatan-section h3 {
            font-size: 13px;
            margin-bottom: 10px;
            color: #b91c1c;
        }
        .catatan-content {
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            min-height: 60px;
        }
        .catatan-footer {
            text-align: right;
            margin-top: 10px;
            font-size: 11px;
            color: #666;
        }
        .keterangan {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        .keterangan h4 {
            margin-bottom: 8px;
        }
        .keterangan-grid {
            display: table;
            width: 100%;
        }
        .keterangan-item {
            display: table-cell;
            width: 50%;
        }
        .signature-section {
            margin-top: 40px;
            width: 100%;
        }
        .signature-table {
            width: 100%;
        }
        .signature-table td {
            text-align: center;
            vertical-align: top;
            padding: 10px;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-a { background-color: #10b981; color: white; }
        .badge-b { background-color: #3b82f6; color: white; }
        .badge-c { background-color: #f59e0b; color: #333; }
        .badge-d { background-color: #f97316; color: white; }
        .badge-e { background-color: #dc2626; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>RAPOR HASIL BELAJAR SISWA</h1>
            <h2>Semester {{ $semester }} - Tahun Ajaran {{ $tahun_ajaran }}</h2>
        </div>

        <!-- Info Siswa -->
        <div class="info-section">
            <table class="info-table">
                <tr>
                    <td class="label">Nama Siswa</td>
                    <td>: {{ $siswa->user->name ?? '-' }}</td>
                    <td class="label">Semester</td>
                    <td>: {{ $semester }}</td>
                </tr>
                <tr>
                    <td class="label">NIS</td>
                    <td>: {{ $siswa->user->username ?? '-' }}</td>
                    <td class="label">Tahun Ajaran</td>
                    <td>: {{ $tahun_ajaran }}</td>
                </tr>
                <tr>
                    <td class="label">Kelas</td>
                    <td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                      <td class="label">Jurusan</td>
                    <td>: {{ $siswa->kelas->jurusan->nama_jurusan ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- Tabel Nilai -->
        <table class="nilai-table">
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th>Mata Pelajaran</th>
                    <th width="80">Nilai Akhir</th>
                    <th width="60">Huruf</th>
                    <th width="100">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekaps as $rekap)
                    @php
                        $nilai = $rekap->nilai_akhir;
                        if ($nilai >= 90) {
                            $huruf = 'A';
                            $badge = 'badge-a';
                            $ket = 'Sangat Baik';
                        } elseif ($nilai >= 80) {
                            $huruf = 'B';
                            $badge = 'badge-b';
                            $ket = 'Baik';
                        } elseif ($nilai >= 70) {
                            $huruf = 'C';
                            $badge = 'badge-c';
                            $ket = 'Cukup';
                        } elseif ($nilai >= 60) {
                            $huruf = 'D';
                            $badge = 'badge-d';
                            $ket = 'Kurang';
                        } else {
                            $huruf = 'E';
                            $badge = 'badge-e';
                            $ket = 'Sangat Kurang';
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="mapel">{{ $rekap->mapel->nama_mapel ?? '-' }}</td>
                        <td><strong>{{ number_format($rekap->nilai_akhir, 2) }}</strong></td>
                        <td><span class="badge {{ $badge }}">{{ $huruf }}</span></td>
                        <td>{{ $ket }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data nilai</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Rata-rata -->
        <div class="rata-rata">
            Rata-rata Keseluruhan: <span style="color: #b91c1c; font-size: 16px;">{{ number_format($rata_rata, 2) }}</span>
        </div>

        <!-- Presensi Section -->
        <div class="presensi-section">
            <h3>Rekap Kehadiran</h3>
            <table class="presensi-table">
                <thead>
                    <tr>
                        <th width="33%">Izin</th>
                        <th width="33%">Sakit</th>
                        <th width="33%">Tanpa Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $presensi['izin'] ?? 0 }}</td>
                        <td>{{ $presensi['sakit'] ?? 0 }}</td>
                        <td>{{ $presensi['alpa'] ?? 0 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Ekstrakurikuler Section -->
        <div class="ekstrakurikuler-section">
            <h3>Ekstrakurikuler yang Diikuti</h3>
            @if($ekstrakurikuler->count() > 0)
                <table class="ekstrakurikuler-table">
                    <thead>
                        <tr>
                            <th width="40">No</th>
                            <th class="nama">Nama Ekstrakurikuler</th>
                            <th width="100">Pembina</th>
                            <th width="100">Jadwal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ekstrakurikuler as $index => $ekstra)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="nama">{{ $ekstra->nama_extra }}</td>
                            <td>{{ $ekstra->pembina->user->name }}</td>
                            <td>{{ $ekstra->jadwal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="font-style: italic; color: #666;">Siswa tidak mengikuti ekstrakurikuler.</p>
            @endif
        </div>

        <!-- ============================= TAMBAHKAN BAGIAN PRESTASI ============================= -->
        <!-- Prestasi Section -->
        <div class="prestasi-section">
            <h3>Prestasi yang Diraih</h3>
            @if($prestasi->count() > 0)
                <table class="prestasi-table">
                    <thead>
                        <tr>
                            <th width="40">No</th>
                            <th class="nama">Nama Prestasi</th>
                            <th width="80">Jenis</th>
                            <th width="80">Tingkat</th>
                            <th width="80">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestasi as $index => $prest)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="nama">{{ $prest->nama_prestasi }}</td>
                            <td>{{ $prest->jenis }}</td>
                            <td>{{ $prest->tingkat }}</td>
                            <td>{{ \Carbon\Carbon::parse($prest->tanggal)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="font-style: italic; color: #666;">Belum ada prestasi yang dicatat untuk semester ini.</p>
            @endif
        </div>
        <!-- ============================= AKHIR BAGIAN YANG DITAMBAHKAN ============================= -->

        <!-- Keterangan Nilai -->
        <div class="keterangan">
            <h4>Keterangan Nilai:</h4>
            <table width="100%">
                <tr>
                    <td width="50%">A : 90 - 100 (Sangat Baik)</td>
                    <td>D : 60 - 69 (Kurang)</td>
                </tr>
                <tr>
                    <td>B : 80 - 89 (Baik)</td>
                    <td>E : 0 - 59 (Sangat Kurang)</td>
                </tr>
                <tr>
                    <td>C : 70 - 79 (Cukup)</td>
                    <td></td>
                </tr>
            </table>
        </div>

        <!-- Catatan Perkembangan -->
        <div class="catatan-section">
            <h3>Catatan Perkembangan dari Wali Kelas</h3>
            <div class="catatan-content">
                @if($catatan)
                    {{ $catatan->catatan }}
                @else
                    <em style="color: #999;">Belum ada catatan perkembangan.</em>
                @endif
            </div>
            @if($catatan)
                <div class="catatan-footer">
                    Wali Kelas: {{ $catatan->walikelas->guru->user->name ?? '-' }}
                </div>
            @endif
        </div>

        <!-- Tanda Tangan -->
        <div class="signature-section">
            <table class="signature-table">
                <tr>
                    <td width="50%">
                        <p>Orang Tua/Wali</p>
                        <div class="signature-line"></div>
                        <p>( ............................ )</p>
                    </td>
                    <td width="50%">
                        <p>Kepala Sekolah</p>
                        <div class="signature-line"></div>
                        <p>( {{ $catatan->kepsek->user->name ?? '............................' }} )</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>