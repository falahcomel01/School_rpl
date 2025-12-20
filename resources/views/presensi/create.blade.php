<x-app-layout>

<style>
    .card { 
        background: #fff; 
        border-radius: 12px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.08); 
        border: 1px solid #f1dada; 
        padding: 26px; 
        transition: 0.25s; 
    }
    .card:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,0.1); }

    .header-title { 
        font-size: 1.25rem; font-weight: 700; 
        color: #b91c1c; border-bottom: 3px solid #b91c1c; 
        padding-bottom: 8px; margin-bottom: 18px; 
        display:inline-block; 
    }

    label { display:block; font-weight:600; color:#374151; margin-bottom:6px; }
    input, select, textarea {
        width:100%; padding:10px; 
        border-radius:8px; border:1px solid #f3c5c5; 
        font-size:14px;
    }

    .table-wrap { overflow-x:auto; border-radius:8px; border:1px solid #f3c5c5; margin-top:14px; }
    table { width:100%; border-collapse:collapse; font-size:14px; }
    thead { background:#fef2f2; color:#7f1d1d; }
    th, td { padding:10px 12px; border-bottom:1px solid #fbeaea; }

    .btn-primary { background:#dc2626; color:#fff; padding:10px 16px; border-radius:8px; font-weight:600; cursor:pointer; border:none; }
    .btn-secondary { background:#e5e7eb; padding:10px 16px; border-radius:8px; text-decoration:none; color:#374151; display:inline-block; }

    .right { display:flex; justify-content:flex-end; gap:10px; margin-top:18px; }
    .muted { color:#9ca3af; font-style:italic; font-size:12px; }

    .info-box { background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:12px; margin-bottom:16px; }
</style>

<div class="py-10">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="card">

            <h3 class="header-title">Form Tambah Presensi</h3>

            @if ($errors->any())
                <div style="background:#fee2e2; border-left:4px solid #dc2626; color:#7f1d1d; padding:10px; border-radius:6px; margin-bottom:12px;">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($jadwal)
                <div class="info-box">
                    <strong>{{ $jadwal->mapel->nama_mapel }}</strong> - 
                    <strong>{{ $jadwal->kelas->nama_kelas }}</strong><br>
                    <span class="muted">{{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                </div>

                {{-- Tanggal Presensi (langsung tampil text, tanpa dropdown) --}}
                <div class="mb-4">
                    <label class="font-semibold">Tanggal Presensi *</label>
                    <div style="padding:10px; border:1px solid #f3c5c5; border-radius:8px; background:#fdfdfd;">
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <form method="POST" action="{{ route('presensi.store') }}">
                    @csrf

                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                    {{-- Status Guru --}}
                    <div style="margin-bottom:16px;">
                        <label for="status_guru">Status Guru *</label>
                        @php 
                            $curGuruStatus = old('status_guru') ?? ($guruIzin ? $guruIzin->status : 'hadir');
                        @endphp

                        <select name="status_guru" id="status_guru" required>
                            <option value="hadir" {{ $curGuruStatus == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin"  {{ $curGuruStatus == 'izin'  ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ $curGuruStatus == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="alpa"  {{ $curGuruStatus == 'alpa'  ? 'selected' : '' }}>Alpa</option>
                        </select>
                    </div>

                    {{-- Tabel Siswa --}}
                    <label style="margin-top:20px;">Daftar Siswa</label>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:50px;">No</th>
                                    <th>Nama Siswa</th>
                                    <th style="width:180px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswas as $index => $siswa)
                                    @php
                                        $selected = old("status_siswa.{$siswa->user->id}", $siswa->status_default);
                                    @endphp
                                    <tr>
                                        <td style="text-align:center;">{{ $index + 1 }}</td>
                                        <td>{{ $siswa->user->name }}</td>
                                        <td>
                                            <select name="status_siswa[{{ $siswa->user->id }}]">
                                                <option value="hadir" {{ $selected == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                <option value="izin"  {{ $selected == 'izin'  ? 'selected' : '' }}>Izin</option>
                                                <option value="sakit" {{ $selected == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                <option value="alpa"  {{ $selected == 'alpa'  ? 'selected' : '' }}>Alpa</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="right">
                        <a href="{{ route('presensi.index') }}" class="btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary">Simpan Presensi</button>
                    </div>

                </form>

            @else
                <div style="padding:40px; text-align:center; color:#9ca3af;">
                    <p>Belum ada jadwal yang dipilih</p>
                    <p>Silakan pilih jadwal dari halaman 
                        <a href="{{ route('presensi.index') }}" style="color:#dc2626;">daftar jadwal</a>
                    </p>
                </div>
            @endif

        </div>
    </div>
</div>

</x-app-layout>
