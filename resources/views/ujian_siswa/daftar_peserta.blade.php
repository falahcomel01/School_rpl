<x-app-layout>
    <x-slot name="header">
        <div class="page-header">
            <div class="icon-box">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
                <h2>Hasil Ujian Siswa</h2>
                <p>{{ $ujian->jenis_ujian }} • {{ $ujian->kelas->nama_kelas ?? '' }}</p>
            </div>
        </div>
    </x-slot>

    <div class="content-wrapper">

        {{-- STATISTIC CARDS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <p>Total Siswa</p>
                <h3>{{ $ujianSiswas->count() }}</h3>
            </div>

            <div class="stat-card success">
                <p>Selesai</p>
                <h3>{{ $ujianSiswas->where('status', 'selesai')->count() }}</h3>
            </div>

            <div class="stat-card warning">
                <p>Sedang Dikerjakan</p>
                <h3>{{ $ujianSiswas->where('status', 'sedang_dikerjakan')->count() }}</h3>
            </div>

            <div class="stat-card info">
                <p>Rata-rata Nilai</p>
                <h3>
                    {{ $ujianSiswas->where('status', 'selesai')->avg('nilai_total')
                        ? number_format($ujianSiswas->where('status', 'selesai')->avg('nilai_total'), 2)
                        : '-' }}
                </h3>
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="table-card">
            <div class="table-header">
                <span>📋 Daftar Peserta Ujian</span>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($ujianSiswas as $index => $us)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $us->siswa?->user?->username ?? '-' }}</td>
                            <td><strong>{{ $us->siswa?->user?->name ?? 'N/A' }}</strong></td>

                            <td>
                                @if($us->paket)
                                    <span class="badge badge-blue">{{ $us->paket }}</span>
                                @else <span>-</span> @endif
                            </td>

                            <td>
                                @if($us->status === 'selesai')
                                    <span class="badge badge-green">✔ Selesai</span>
                                @elseif($us->status === 'sedang_dikerjakan')
                                    <span class="badge badge-yellow">⌛ Proses</span>
                                @else
                                    <span class="badge badge-gray">{{ $us->status }}</span>
                                @endif
                            </td>

                            <td>{{ $us->waktu_mulai?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td>{{ $us->waktu_selesai?->format('d/m/Y H:i') ?? '-' }}</td>

                            <td>
                                @if($us->status === 'selesai')
                                    <span class="value">{{ $us->nilai_total ?? 0 }}</span>
                                @else -
                                @endif
                            </td>

                            <td>
                                @if($us->status === 'selesai')
                                    <a href="{{ route('ujian_siswa.detail_penilaian', $us->id) }}" class="btn-view">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @else <span>-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-row">
                                <i class="fa-solid fa-inbox fa-2x"></i>
                                <p>Tidak ada peserta yang mengerjakan ujian ini.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<style>
    .content-wrapper {
        max-width: 1400px;
        margin: auto;
        padding: 18px;
    }

    /* HEADER */
    .page-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 25px;
    }

    .page-header h2 {
        font-size: 26px;
        font-weight: 800;
        margin: 0;
        color: #1f2937;
    }

    .page-header p {
        margin: 0;
        font-size: 14px;
        color: #6b7280;
    }

    .icon-box {
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #b91c1c;
        color: white;
        font-size: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(185, 28, 28, 0.3);
    }

    /* STATS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
        gap: 16px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 14px;
        font-size: 15px;
        border: 1px solid #e5e7eb;
        transition: .2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    .stat-card h3 {
        font-size: 28px;
        margin-top: 8px;
        font-weight: 800;
    }

    .stat-card.success { border-left: 6px solid #22c55e }
    .stat-card.warning { border-left: 6px solid #fbbf24 }
    .stat-card.info { border-left: 6px solid #2563eb }

    /* TABLE */
    .table-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #ddd;
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
    }

    .table-header {
        background: #b91c1c;
        padding: 18px;
        font-size: 18px;
        font-weight: bold;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    th, td {
        padding: 14px;
        border-bottom: 1px solid #eee;
    }

    tbody tr:hover {
        background: #fff6f6;
    }

    /* BADGES */
    .badge {
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-blue { background:#e0f2fe; color:#0369a1; }
    .badge-green { background:#dcfce7; color:#166534; }
    .badge-yellow { background:#fff7c2; color:#92400e; }
    .badge-gray { background:#e5e7eb; color:#374151; }

    /* VIEW BUTTON */
    .btn-view {
        background:#2563eb;
        padding:10px;
        border-radius:8px;
        color:white;
        display:inline-flex;
        justify-content:center;
        align-items:center;
        transition:.2s;
    }

    .btn-view:hover {
        background:#1e40af;
        transform:scale(1.1);
    }

    .empty-row {
        text-align:center;
        padding: 35px;
        color:#6b7280;
    }
</style>
</x-app-layout>
