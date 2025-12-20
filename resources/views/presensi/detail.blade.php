<x-app-layout>

<style>
    .card {
        background:#fff; border-radius:12px; 
        box-shadow:0 4px 10px rgba(0,0,0,0.08);
        border:1px solid #f1dada; padding:25px;
    }
    .btn-back {
        background:#6b7280; color:white; 
        padding:6px 14px; border-radius:6px;
        font-size:14px; margin-bottom:20px; display:inline-block;
    }
    table { width:100%; border-collapse:collapse; margin-top:12px; }
    thead { background:#b91c1c; color:white; }
    th, td { border:1px solid #f3c5c5; padding:10px 12px; }

    .btn-edit {
        background:#dc2626; color:white; padding:8px 18px;
        border-radius:8px; font-weight:600; text-decoration:none;
    }

    .badge { padding:4px 12px; border-radius:6px; font-weight:600; }
    .badge-hadir{background:#d1fae5;color:#065f46;}
    .badge-izin{background:#fef3c7;color:#92400e;}
    .badge-sakit{background:#dbeafe;color:#1e40af;}
    .badge-alpa{background:#fee2e2;color:#991b1b;}
</style>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('presensi.show', $jadwal->id) }}" class="btn-back">← Kembali</a>

        <div class="card">

            {{-- Header tanggal + tombol edit --}}
            <div style="display:flex; justify-content:space-between; align-items:center;">
                
                <div style="background:#fef2f2;border:1px solid #fecaca;
                            padding:10px;border-radius:8px;font-weight:600;color:#b91c1c;">
                    📅 {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                </div>

                {{-- Hitung apakah masih bisa edit --}}
                @php
                    $firstPresensi = $presensis->first();
                    $allowEdit = false;
                    if ($firstPresensi) {
                        $allowEdit = now()->diffInHours($firstPresensi->created_at) <= 24;
                    }
                @endphp

                @if($allowEdit)
                    @can('create presensisiswa')
                        <a href="{{ route('presensi.edit', ['jadwal_id' => $jadwal->id, 'tanggal' => $tanggal]) }}" 
                           class="btn-edit">
                            Edit Presensi
                        </a>
                    @endcan
                @endif

            </div>

            {{-- ⚡ DAFTAR PRESENSI GURU --}}
            {{-- ⚡ DAFTAR PRESENSI GURU — tampil hanya untuk role selain siswa --}}
@if(!auth()->user()->hasRole('siswa'))

<h3 style="margin-top:25px;font-size:20px;font-weight:bold;color:#b91c1c;">
    Presensi Guru
</h3>

<table>
    <thead>
        <tr>
            <th style="width:60px;">No</th>
            <th>Nama Guru</th>
            <th style="width:130px;">Status</th>
        </tr>
    </thead>
    <tbody>
        @php $noGuru = 1; @endphp

        @foreach($presensis->where('user_id', $jadwal->guru->user_id) as $guru)
            <tr>
                <td class="text-center">{{ $noGuru++ }}</td>
                <td>{{ $guru->user->name }}</td>
                <td class="text-center">
                    <span class="badge badge-{{ strtolower($guru->status) }}">
                        {{ ucfirst($guru->status) }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endif


            {{-- ⚡ DAFTAR PRESENSI SISWA --}}
            <h3 style="margin-top:35px;font-size:20px;font-weight:bold;color:#b91c1c;">
                Presensi Siswa
            </h3>

            <table>
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Siswa</th>
                        <th style="width:130px;">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @php $noSiswa = 1; @endphp

                    @foreach($presensis->where('user_id', '!=', $jadwal->guru->user_id) as $p)
                        <tr>
                            <td class="text-center">{{ $noSiswa++ }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td class="text-center">
                                <span class="badge badge-{{ strtolower($p->status) }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach

                    @if($noSiswa == 1)
                        <tr>
                            <td colspan="3" class="text-center text-gray-400 italic" style="padding:20px;">
                                Tidak ada siswa terdata
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>

</x-app-layout>
