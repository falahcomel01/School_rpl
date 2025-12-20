<x-app-layout>
  <div class="container">

    {{-- Notifikasi Success --}}
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Notifikasi Error --}}
    @if(session('error'))
      <div class="alert-error">
        {{ session('error') }}
      </div>
    @endif

    {{-- Info --}}
    <div class="alert-info">
      <i class="fa-solid fa-info-circle me-2"></i>
      <strong>Info:</strong> Rapor ditampilkan langsung dari Rekap Nilai yang sudah di-generate.
    </div>

    {{-- Tabel --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Siswa</th>
            <th class="text-center">Kelas</th>
            <th class="text-center">Semester</th>
            <th class="text-center">Tahun Ajaran</th>
            <th class="text-center">Jumlah Mapel</th>
            <th class="text-center">Rata-rata</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($rapors as $r)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $r->siswa->user->name ?? '-' }}</td>
              <td>{{ $r->kelas->nama_kelas ?? '-' }}</td>
              <td class="text-center">{{ $r->semester }}</td>
              <td class="text-center">{{ $r->tahun_ajaran }}</td>
              <td class="text-center">
                <span class="badge badge-mapel">{{ $r->jumlah_mapel }} mapel</span>
              </td>
              <td class="text-center">
                <strong class="text-rata">{{ number_format($r->rata_rata, 2) }}</strong>
              </td>
              <td class="text-center">
                <small>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</small>
              </td>
              <td class="text-center">
                <a href="{{ route('rapor.show', [$r->siswa_id, $r->semester, str_replace('/', '-', $r->tahun_ajaran)]) }}"
                   class="btn btn-sm btn-primary">
                  <i class="fa-solid fa-eye me-1"></i> Lihat Rapor
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="empty-cell">
                <i class="fa-solid fa-circle-info me-2"></i>
                Belum ada rekap nilai. Silakan generate rekap nilai terlebih dahulu.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  <style>
    /* General Body & Container */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 1200px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    /* Notifikasi */
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px 16px;
      border-radius: 6px;
      margin-bottom: 16px;
      font-size: 14px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #b91c1c;
      color: #991b1b;
      padding: 10px 16px;
      border-radius: 6px;
      margin-bottom: 16px;
      font-size: 14px;
    }

    .alert-info {
      background-color: #dbeafe;
      border-left: 4px solid #3b82f6;
      color: #1e40af;
      padding: 12px 16px;
      border-radius: 6px;
      margin-bottom: 24px;
      font-size: 14px;
    }

    /* Tabel */
    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      color: #333;
    }

    /* PERBAIKAN: 'thead' bukan 'ad' */
    thead {
      background-color: #b91c1c;
      color: white;
      text-transform: uppercase;
      font-size: 13px;
    }

    th, td {
      border: 1px solid #f3c5c5;
      padding: 12px 10px;
      text-align: center;
    }

    td {
      text-align: left;
    }

    .text-center {
      text-align: center !important;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    /* PERBAIKAN: Warna hover yang lebih jelas */
    tbody tr:hover {
      background-color: #fde8e8;
      cursor: pointer;
    }

    /* Badge Jumlah Mapel */
    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
    }

    .badge-mapel {
      background-color: #fde8e8;
      color: #b91c1c;
      border: 1px solid #fecaca;
    }

    /* Rata-rata */
    .text-rata {
      color: #b91c1c;
      font-weight: 700;
    }

    /* Tombol Aksi */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.2s;
      border: none;
    }

    .btn-primary {
      background-color: #b91c1c;
      color: white;
    }

    .btn-primary:hover {
      background-color: #991b1b;
    }

    /* Empty State */
    .empty-cell {
      text-align: center;
      padding: 24px;
      color: #9ca3af;
      font-style: italic;
    }

    /* Utility */
    small {
      font-size: 12px;
      color: #666;
    }

    .me-2 { margin-right: 8px; }
    .me-1 { margin-right: 6px; }
  </style>

</x-app-layout>