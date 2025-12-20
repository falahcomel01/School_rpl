<x-app-layout>

  <div class="elite-container">

    @if(session('success'))
      <div class="elite-alert elite-alert-success">
        {{ session('success') }}
      </div>
    @endif

    <!-- Info Pembobotan -->
    <div class="elite-info-grid mb-6">
      <div class="elite-card elite-card-info">
        <div class="elite-card-header">
          📚 Informasi Pembobotan
        </div>
        <div class="elite-card-body">
          <p><strong>Kelas:</strong> {{ $pembobotan->kelas->nama_kelas }}</p>
          <p><strong>Mapel:</strong> {{ $pembobotan->mapel->nama_mapel }}</p>
          <p><strong>Semester:</strong> {{ $pembobotan->semester }}</p>
          <p class="mb-0"><strong>Tahun Ajaran:</strong> {{ $pembobotan->tahun_ajaran }}</p>
        </div>
      </div>

      <div class "elite-card elite-card-weight">
        <div class="elite-card-header">
          ⚖️ Bobot Penilaian
        </div>
        <div class="elite-card-body">
          <p class="mb-2">
            <span class="elite-badge elite-badge-primary">Tugas: {{ $pembobotan->bobot_tugas }}%</span>
          </p>
          <p class="mb-2">
            <span class="elite-badge elite-badge-warning">UTS: {{ $pembobotan->bobot_uts }}%</span>
          </p>
          <p class="mb-0">
            <span class="elite-badge elite-badge-success">UAS: {{ $pembobotan->bobot_uas }}%</span>
          </p>
        </div>
      </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="elite-action-bar mb-6">
      <a href="{{ route('rekap_nilai.generate', $pembobotan->id) }}" 
         class="elite-btn elite-btn-generate"
         onclick="return confirm('Generate/update rekap nilai untuk kelas ini?')">
        <i class="fa-solid fa-sync-alt me-2"></i> Re-Generate Rekap
      </a>
      <a href="{{ route('rekap_nilai.index') }}" class="elite-btn elite-btn-secondary">
        <i class="fa-solid fa-arrow-left me-2"></i> Kembali
      </a>
    </div>

    <!-- Tabel Rekap -->
    <div class="elite-table-wrapper">
      <table class="elite-table">
        <thead>
          <tr>
            <th class="text-center">Ranking</th>
            <th class="text-center">NIS</th>
            <th class="text-center">Nama Siswa</th>
            <th class="text-center">Rata² Tugas</th>
            <th class="text-center">Nilai UTS</th>
            <th class="text-center">Nilai UAS</th>
            <th class="text-center">Nilai Akhir</th>
            <th class="text-center">Huruf</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($rekaps as $r)
            <tr>
              <td class="text-center">
                <strong class="text-ranking">{{ $loop->iteration }}</strong>
              </td>
              <td class="text-center">{{ $r->siswa->user->username ?? '-' }}</td>
              <td>{{ $r->siswa->user->name ?? '-' }}</td>
              <td class="text-center">{{ number_format($r->rata_rata_tugas, 2) }}</td>
              <td class="text-center">{{ number_format($r->nilai_uts, 2) }}</td>
              <td class="text-center">{{ number_format($r->nilai_uas, 2) }}</td>
              <td class="text-center">
                <strong class="text-final">{{ number_format($r->nilai_akhir, 2) }}</strong>
              </td>
              <td class="text-center">
                @php
                  $huruf = '';
                  $badgeClass = '';
                  if ($r->nilai_akhir >= 90) {
                    $huruf = 'A';
                    $badgeClass = 'elite-badge-grade-a';
                  } elseif ($r->nilai_akhir >= 80) {
                    $huruf = 'B';
                    $badgeClass = 'elite-badge-grade-b';
                  } elseif ($r->nilai_akhir >= 70) {
                    $huruf = 'C';
                    $badgeClass = 'elite-badge-grade-c';
                  } elseif ($r->nilai_akhir >= 60) {
                    $huruf = 'D';
                    $badgeClass = 'elite-badge-grade-d';
                  } else {
                    $huruf = 'E';
                    $badgeClass = 'elite-badge-grade-e';
                  }
                @endphp
                <span class="elite-badge {{ $badgeClass }}">{{ $huruf }}</span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="elite-table-empty">
                <i class="fa-solid fa-circle-info me-2"></i>
                Belum ada rekap nilai. Silakan klik "Generate Rekap" untuk menghitung nilai.
              </td>
            </tr>
          @endforelse
        </tbody>

        @if($rekaps->count() > 0)
        <tfoot>
          <tr>
            <th colspan="3" class="text-end elite-footer-label">Rata-rata Kelas:</th>
            <th class="text-center">{{ number_format($rekaps->avg('rata_rata_tugas'), 2) }}</th>
            <th class="text-center">{{ number_format($rekaps->avg('nilai_uts'), 2) }}</th>
            <th class="text-center">{{ number_format($rekaps->avg('nilai_uas'), 2) }}</th>
            <th class="text-center">
              <strong class="text-final">{{ number_format($rekaps->avg('nilai_akhir'), 2) }}</strong>
            </th>
            <th></th>
          </tr>
        </tfoot>
        @endif
      </table>
    </div>

  </div>

  <style>
    body {
      font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #2d3748;
    }

    .elite-container {
      max-width: 1200px;
      margin: 48px auto;
      background: white;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
      border: 1px solid #eee;
      padding: 32px;
    }

    /* Alert */
    .elite-alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 24px;
      font-size: 14px;
    }
    .elite-alert-success {
      background-color: #e6f4ea;
      border-left: 4px solid #1e8e3e;
      color: #137333;
    }

    /* Info Grid */
    .elite-info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-bottom: 28px;
    }
    @media (max-width: 768px) {
      .elite-info-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Card */
    .elite-card {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .elite-card-header {
      padding: 12px 16px;
      font-weight: 700;
      font-size: 15px;
    }
    .elite-card-info .elite-card-header {
      background-color: #dbeafe;
      color: #1e40af;
    }
    .elite-card-weight .elite-card-header {
      background-color: #fef9c3;
      color: #92400e;
    }
    .elite-card-body {
      padding: 16px;
    }
    .elite-card-body p {
      margin: 0 0 8px;
      font-size: 14px;
    }
    .elite-card-body p:last-child {
      margin-bottom: 0;
    }

    /* Badge */
    .elite-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
    }
    .elite-badge-primary { background: #dbeafe; color: #1e40af; }
    .elite-badge-warning { background: #fef9c3; color: #92400e; }
    .elite-badge-success { background: #dcfce7; color: #166534; }

    /* Grade Badge */
    .elite-badge-grade-a { background: #dcfce7; color: #166534; font-weight: 700; }
    .elite-badge-grade-b { background: #dbeafe; color: #1e40af; font-weight: 700; }
    .elite-badge-grade-c { background: #fef9c3; color: #92400e; font-weight: 700; }
    .elite-badge-grade-d { background: #ffedd5; color: #c2410c; font-weight: 700; }
    .elite-badge-grade-e { background: #fee2e2; color: #b91c1c; font-weight: 700; }

    /* Tombol Aksi */
    .elite-action-bar {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      margin-bottom: 28px;
      flex-wrap: wrap;
    }
    .elite-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 20px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
      white-space: nowrap;
    }
    .elite-btn-generate {
      background: #10b981;
      color: white;
    }
    .elite-btn-generate:hover {
      background: #065f46;
    }
    .elite-btn-secondary {
      background: #f1f5f9;
      color: #334155;
      border: 1px solid #e2e8f0;
    }
    .elite-btn-secondary:hover {
      background: #e2e8f0;
    }

    /* Tabel */
    .elite-table-wrapper {
      overflow-x: auto;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .elite-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }
    .elite-table thead {
      background-color: #b91c1c;
      color: white;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }
    .elite-table th,
    .elite-table td {
      border: 1px solid #f3c5c5;
      padding: 14px 12px;
      text-align: center;
    }
    .elite-table td {
      text-align: left;
    }
    .elite-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .elite-table tbody tr:hover {
      background-color: #fdf7f7;
    }

    /* Footer Tabel */
    .elite-table tfoot th,
    .elite-table tfoot td {
      background-color: #f8fafc;
      font-weight: 600;
    }
    .elite-footer-label {
      font-weight: 700;
      color: #b91c1c;
    }

    /* Teks Khusus */
    .text-ranking {
      color: #b91c1c;
    }
    .text-final {
      color: #b91c1c;
      font-weight: 700;
    }

    /* Empty */
    .elite-table-empty {
      text-align: center;
      padding: 32px;
      color: #9ca3af;
      font-style: italic;
      background: #f9fafb;
    }

    /* Utility */
    .text-center { text-align: center !important; }
    .text-end { text-align: right !important; }
    .mb-6 { margin-bottom: 32px; }
    .me-2 { margin-right: 8px; }

    /* Responsif */
    @media (max-width: 768px) {
      .elite-container {
        padding: 20px;
        margin: 24px 12px;
      }
      .elite-action-bar {
        justify-content: center;
      }
      .elite-table th,
      .elite-table td {
        padding: 10px 8px;
        font-size: 13px;
      }
    }
  </style>

</x-app-layout>