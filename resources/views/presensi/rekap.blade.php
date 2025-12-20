
<x-app-layout>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background: #fff;
            border: 1px solid #f1dada;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,.08);
            padding: 25px;
            margin-bottom: 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #b91c1c;
            border-bottom: 3px solid #b91c1c;
            padding-bottom: 8px;
            margin: 0;
        }

        .btn-back {
            background: #6b7280;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-back:hover {
            background: #4b5563;
        }

        .info-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-box p {
            margin: 5px 0;
            color: #991b1b;
        }

        .filter-grid {
            display: grid;
            gap: 15px;
            margin-bottom: 15px;
        }

        .filter-grid.cols-2 { grid-template-columns: repeat(2, 1fr); }
        .filter-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }
        .filter-grid.cols-4 { grid-template-columns: repeat(4, 1fr); }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #f3c5c5;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: #dc2626;
        }

        .btn-filter {
            background: #dc2626;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .btn-filter:hover {
            background: #b91c1c;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #b91c1c;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #fecaca;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #b91c1c;
            color: white;
        }

        th, td {
            border: 1px solid #f3c5c5;
            padding: 10px 12px;
            text-align: center;
        }

        th {
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: .5px;
        }

        tbody tr:hover {
            background: #fde8e8;
            transition: .2s;
        }

        .status-hadir { color: #16a34a; font-weight: 700; }
        .status-izin { color: #ca8a04; font-weight: 700; }
        .status-sakit { color: #2563eb; font-weight: 700; }
        .status-alpa { color: #dc2626; font-weight: 700; }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
        }

        .full-width {
            grid-column: 1 / -1;
        }
    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="card">
                <div class="header-section">
                    <h2 class="header-title">
                        Rekap Presensi
                        @if(auth()->user()->hasRole('siswa'))
                            Saya
                        @elseif(auth()->user()->hasRole('orangtua'))
                            Anak
                        @elseif(auth()->user()->hasRole('guru'))
                            Siswa
                        @endif
                    </h2>
                    <a href="{{ route('presensi.index') }}" class="btn-back">Kembali</a>
                </div>

                {{-- INFO SISWA (untuk orangtua) --}}
                @if(auth()->user()->hasRole('orangtua') && isset($siswa))
                <div class="info-box">
                    <p><strong>Nama:</strong> {{ $siswa->user->name }}</p>
                    <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
                @endif
            </div>

            {{-- FILTER SECTION --}}
            <div class="card">
                <form method="GET" action="{{ route('presensi.rekap') }}">
                    <div class="filter-grid 
                        @if(auth()->user()->hasAnyRole(['superadmin','tus'])) cols-4
                        @elseif(auth()->user()->hasRole('guru')) cols-3
                        @else cols-2
                        @endif">

                        {{-- FILTER MAPEL (Superadmin/TUS only) --}}
                        @if(auth()->user()->hasAnyRole(['superadmin','tus']) && isset($mapelList))
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mapel_id" class="form-control" required>
                                @foreach($mapelList as $mapel)
                                    <option value="{{ $mapel->id }}" {{ ($mapel_id ?? '') == $mapel->id ? 'selected' : '' }}>
                                        {{ $mapel->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        {{-- MAPEL UNTUK GURU (READ ONLY) --}}
                        @if(auth()->user()->hasRole('guru') && isset($mapelGuru))
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <input type="text" value="{{ $mapelGuru->nama_mapel }}" class="form-control" readonly>
                        </div>
                        @endif

                        {{-- FILTER KELAS (Superadmin/TUS/Guru) --}}
                        @if(auth()->user()->hasAnyRole(['superadmin','tus','guru']) && isset($kelasList))
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas_id" class="form-control" required>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ ($kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        {{-- FILTER TANGGAL MULAI --}}
                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ $start ?? '' }}" class="form-control">
                        </div>

                        {{-- FILTER TANGGAL SELESAI --}}
                        <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" value="{{ $end ?? '' }}" class="form-control">
                        </div>

                        {{-- TOMBOL FILTER --}}
                        <div class="form-group full-width">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn-filter">Filter Data</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- TABEL REKAP UNTUK SUPERADMIN/TUS/KEPSEK --}}
            @if(auth()->user()->hasAnyRole(['superadmin','tus','kepsek']))
                
                {{-- TABEL GURU --}}
                @if(isset($rekapGuru) && count($rekapGuru) > 0)
                <div class="card">
                    <h3 class="section-title">Rekap Presensi Guru</h3>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Guru</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekapGuru as $r)
                                <tr>
                                    <td>{{ $r['nama'] }}</td>
                                    <td>{{ $r['kelas'] }}</td>
                                    <td>{{ $r['mapel'] }}</td>
                                    <td class="status-hadir">{{ $r['hadir'] }}</td>
                                    <td class="status-izin">{{ $r['izin'] }}</td>
                                    <td class="status-sakit">{{ $r['sakit'] }}</td>
                                    <td class="status-alpa">{{ $r['alpa'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                {{-- TABEL SISWA --}}
                @if(isset($rekapSiswa) && count($rekapSiswa) > 0)
                <div class="card">
                    <h3 class="section-title">Rekap Presensi Siswa</h3>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekapSiswa as $r)
                                <tr>
                                    <td>{{ $r['nama'] }}</td>
                                    <td>{{ $r['kelas'] }}</td>
                                    <td>{{ $r['mapel'] }}</td>
                                    <td class="status-hadir">{{ $r['hadir'] }}</td>
                                    <td class="status-izin">{{ $r['izin'] }}</td>
                                    <td class="status-sakit">{{ $r['sakit'] }}</td>
                                    <td class="status-alpa">{{ $r['alpa'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                {{-- JIKA TIDAK ADA DATA --}}
                @if((!isset($rekapGuru) || count($rekapGuru) == 0) && (!isset($rekapSiswa) || count($rekapSiswa) == 0))
                <div class="card">
                    <p class="empty-state">Tidak ada data untuk ditampilkan</p>
                </div>
                @endif

            @endif

            {{-- TABEL UNTUK GURU --}}
            @if(auth()->user()->hasRole('guru'))
                
                {{-- TABEL PRESENSI GURU (diri sendiri) --}}
                @if(isset($rekapGuru) && count($rekapGuru) > 0)
                <div class="card">
                    <h3 class="section-title">Rekap Presensi Saya</h3>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekapGuru as $r)
                                <tr>
                                    <td>{{ $r['nama'] }}</td>
                                    <td>{{ $r['kelas'] }}</td>
                                    <td>{{ $r['mapel'] }}</td>
                                    <td class="status-hadir">{{ $r['hadir'] }}</td>
                                    <td class="status-izin">{{ $r['izin'] }}</td>
                                    <td class="status-sakit">{{ $r['sakit'] }}</td>
                                    <td class="status-alpa">{{ $r['alpa'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                {{-- TABEL PRESENSI SISWA --}}
                @if(isset($rekapSiswa) && count($rekapSiswa) > 0)
                <div class="card">
                    <h3 class="section-title">Rekap Presensi Siswa</h3>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekapSiswa as $r)
                                <tr>
                                    <td>{{ $r['nama'] }}</td>
                                    <td>{{ $r['kelas'] }}</td>
                                    <td>{{ $r['mapel'] }}</td>
                                    <td class="status-hadir">{{ $r['hadir'] }}</td>
                                    <td class="status-izin">{{ $r['izin'] }}</td>
                                    <td class="status-sakit">{{ $r['sakit'] }}</td>
                                    <td class="status-alpa">{{ $r['alpa'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                {{-- JIKA TIDAK ADA DATA --}}
                @if((!isset($rekapGuru) || count($rekapGuru) == 0) && (!isset($rekapSiswa) || count($rekapSiswa) == 0))
                <div class="card">
                    <p class="empty-state">Tidak ada data untuk ditampilkan</p>
                </div>
                @endif

            @endif

            {{-- TABEL UNTUK SISWA/ORANGTUA (rekap per mapel) --}}
            @if(auth()->user()->hasAnyRole(['siswa','orangtua']) && isset($rekapPerMapel))
            <div class="card">
                <div class="overflow-x-auto">
                    <table>
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Alpa</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapPerMapel as $r)
                            @php
                                $total = $r['hadir'] + $r['izin'] + $r['sakit'] + $r['alpa'];
                            @endphp
                            <tr>
                                <td style="text-align: left; font-weight: 600;">{{ $r['mapel'] }}</td>
                                <td class="status-hadir">{{ $r['hadir'] }}</td>
                                <td class="status-izin">{{ $r['izin'] }}</td>
                                <td class="status-sakit">{{ $r['sakit'] }}</td>
                                <td class="status-alpa">{{ $r['alpa'] }}</td>
                                <td style="font-weight: 700; color: #374151;">{{ $total }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">Tidak ada data presensi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>