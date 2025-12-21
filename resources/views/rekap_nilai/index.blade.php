<x-app-layout>

  <div class="premium-container">

    @if(session('success'))
      <div class="premium-alert premium-alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="premium-alert premium-alert-error">
        {{ session('error') }}
      </div>
    @endif

    <!-- Tombol Tambah -->
    <div class="premium-header">
      <a href="{{ route('rekap_nilai.create') }}" class="premium-btn premium-btn-primary" title="Set Bobot Baru">
        <i class="fa-solid fa-plus"></i>
      </a>
    </div>

    <!-- Tabel -->
    <div class="premium-table-wrapper">
      <table class="premium-table">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kelas</th>
            <th class="text-center">Jurusan</th>
            <th class="text-center">Mapel</th>
            <th class="text-center">Semester</th>
            <th class="text-center">Tahun Ajaran</th>
            <th class="text-center">Bobot Tugas</th>
            <th class="text-center">Bobot UTS</th>
            <th class="text-center">Bobot UAS</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($pembobotan as $p)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $p->kelas->nama_kelas }}</td>
               <td>{{ $p->kelas->jurusan->nama_jurusan }}</td>
              <td>{{ $p->mapel->nama_mapel }}</td>
              <td class="text-center">{{ $p->semester }}</td>
              <td class="text-center">{{ $p->tahun_ajaran }}</td>
              <td class="text-center">
                <span class="premium-badge premium-badge-primary">{{ $p->bobot_tugas }}%</span>
              </td>
              <td class="text-center">
                <span class="premium-badge premium-badge-warning">{{ $p->bobot_uts }}%</span>
              </td>
              <td class="text-center">
                <span class="premium-badge premium-badge-success">{{ $p->bobot_uas }}%</span>
              </td>

              <!-- Status Generate -->
              <td class="text-center">
                @if($p->rekaps_count > 0)
                  <span class="premium-badge premium-badge-generated">
                    <i class="fa-solid fa-check me-1"></i> {{ $p->rekaps_count }} siswa
                  </span>
                @else
                  <span class="premium-badge premium-badge-pending">
                    <i class="fa-solid fa-clock me-1"></i> Belum di-generate
                  </span>
                @endif
              </td>

              <!-- Aksi (Hanya Ikon) -->
              <td class="text-center">
                <div class="premium-icon-group">
                  <a href="{{ route('rekap_nilai.generate', $p->id) }}"
                     class="premium-icon premium-icon-generate"
                     title="Generate Rekap"
                     onclick="return confirm('Generate/update rekap nilai untuk kelas ini?')">
                    <i class="fa-solid fa-calculator"></i>
                  </a>
                  <a href="{{ route('rekap_nilai.show', $p->id) }}"
                     class="premium-icon premium-icon-view"
                     title="Lihat Rekap">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a href="{{ route('rekap_nilai.edit', $p->id) }}"
                     class="premium-icon premium-icon-edit"
                     title="Edit Bobot">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <form action="{{ route('rekap_nilai.destroy', $p->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus pembobotan ini? Rekap nilai terkait juga akan dihapus!')"
                        class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="premium-icon premium-icon-delete" title="Hapus Bobot">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" class="premium-table-empty">
                <i class="fa-solid fa-circle-info me-2"></i>
                Belum ada pembobotan nilai. Silakan buat pembobotan baru.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  <style>
    body {
      font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #2d3748;
    }

    .premium-container {
      max-width: 1200px;
      margin: 48px auto;
      background: white;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
      border: 1px solid #eee;
      padding: 32px;
    }

    /* Alert */
    .premium-alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }
    .premium-alert-success {
      background-color: #e6f4ea;
      border-left: 4px solid #1e8e3e;
      color: #137333;
    }
    .premium-alert-error {
      background-color: #fce8e6;
      border-left: 4px solid #c5221f;
      color: #991b1b;
    }

    /* Tombol Tambah (ikon) */
    .premium-header {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 24px;
    }
    .premium-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: #b91c1c;
      color: white;
      text-decoration: none;
      transition: all 0.25s ease;
      box-shadow: 0 2px 6px rgba(185, 28, 28, 0.25);
    }
    .premium-btn:hover {
      background: #991b1b;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(185, 28, 28, 0.3);
    }

    /* Tabel */
    .premium-table-wrapper {
      overflow-x: auto;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .premium-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }
    .premium-table thead {
      background-color: #b91c1c;
      color: white;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }
    .premium-table th,
    .premium-table td {
      border: 1px solid #f3c5c5;
      padding: 14px 12px;
      text-align: center;
    }
    .premium-table td {
      text-align: left;
    }
    .premium-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .premium-table tbody tr:hover {
      background-color: #fdf7f7;
    }

    /* Badge */
    .premium-badge {
      display: inline-block;
      padding: 5px 12px;
      border-radius: 30px;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    .premium-badge-primary { background: #dbeafe; color: #1e40af; }
    .premium-badge-warning { background: #fef9c3; color: #92400e; }
    .premium-badge-success { background: #dcfce7; color: #166534; }
    .premium-badge-generated { background: #dcfce7; color: #166534; }
    .premium-badge-pending { background: #fef3c7; color: #92400e; }

    /* Ikon Aksi */
    .premium-icon-group {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .premium-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 8px;
      color: white;
      text-decoration: none;
      transition: all 0.2s ease;
      font-size: 14px;
    }
    .premium-icon-generate {
      background-color: #10b981;
    }
    .premium-icon-generate:hover {
      background-color: #065f46;
    }
    .premium-icon-view {
      background-color: #3b82f6;
    }
    .premium-icon-view:hover {
      background-color: #2563eb;
    }
    .premium-icon-edit {
      background-color: #6b7280;
    }
    .premium-icon-edit:hover {
      background-color: #4b5563;
    }
    .premium-icon-delete {
      background-color: #ef4444;
      border: none;
      cursor: pointer;
    }
    .premium-icon-delete:hover {
      background-color: #dc2626;
    }

    /* Empty */
    .premium-table-empty {
      text-align: center;
      padding: 32px;
      color: #9ca3af;
      font-style: italic;
      background: #f9fafb;
    }

    /* Utility */
    .text-center { text-align: center !important; }
    .d-inline { display: inline; }

    /* Responsif */
    @media (max-width: 768px) {
      .premium-container {
        padding: 20px;
        margin: 24px 12px;
      }
      .premium-table th,
      .premium-table td {
        padding: 10px 8px;
        font-size: 13px;
      }
      .premium-icon {
        width: 32px;
        height: 32px;
        font-size: 13px;
      }
    }
  </style>

</x-app-layout>