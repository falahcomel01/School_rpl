<x-app-layout>
  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        border: 1px solid #f1dada;
        padding: 25px;
    }
    .btn-back {
        background: #6b7280;
        color: white;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 20px;
        display: inline-block;
        text-decoration: none;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
    }
    thead {
        background: #b91c1c;
        color: white;
    }
    th, td {
        border: 1px solid #f3c5c5;
        padding: 10px 12px;
        text-align: left;
    }
    th {
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    tbody tr:nth-child(even) {
        background: #fef2f2;
    }
    tbody tr:hover {
        background: #fde8e8;
    }
    .badge {
        padding: 4px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
    }
    .badge-hadir{ background: #d1fae5; color: #065f46; }
    .badge-izin{ background: #fef3c7; color: #92400e; }
    .badge-sakit{ background: #dbeafe; color: #1e40af; }
    .badge-alpa{ background: #fee2e2; color: #991b1b; }
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        background: #fef2f2;
        padding: 15px 20px;
        border-radius: 8px;
        border: 1px solid #fecaca;
    }
    .header-title {
        font-size: 20px;
        font-weight: bold;
        color: #b91c1c;
        margin: 0;
    }
    .date-display {
        font-size: 18px;
        color: #374151;
        font-weight: 500;
    }
    .edit-container {
        text-align: right;
    }
    .btn-edit {
        background: #dc2626;
        color: white;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        font-size: 14px;
    }
    .btn-edit:hover {
        background: #b91c1c;
    }
  </style>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('presensi_ekstra.show', $ekstra->id) }}" class="btn-back">
            ← Kembali
        </a>

        <div class="card">
            <div class="header-section">
                <div>
                    <h3 class="header-title">{{ $ekstra->nama_extra }}</h3>
                    <p class="date-display">📅 {{ \Carbon\Carbon::parse($tanggal)->format('l, d F Y') }}</p>
                </div>
                <div class="edit-container">
                    {{-- Hitung apakah masih boleh diedit (misalnya, dalam 24 jam) --}}
                    @php
                        $firstPresensi = $presensis->first();
                        $allowEdit = false;
                        if ($firstPresensi) {
                            $allowEdit = now()->diffInHours($firstPresensi->created_at) <= 24;
                        }
                    @endphp
                </div>
            </div>

            {{-- TABEL PRESENSI SISWA (DIPERTAHANKAN) --}}
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
                    @foreach($presensis->where('user_id', '!=', $ekstra->pembina->user_id) as $p)
                        <tr>
                            <td class="text-center">{{ $noSiswa++ }}</td>
                            <td>{{ $p->extraPeserta->siswa->user->name}}</td>
                            <td class="text-center">
                                <span class="badge badge-{{ strtolower($p->status) }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach

                    @if($noSiswa == 1)
                        <tr>
                            <td colspan="3" class="text-center" style="padding:20px;color:#9ca3af;font-style:italic;">
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