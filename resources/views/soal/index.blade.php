<x-app-layout>

  <div class="container">

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Judul --}}
    <div class="top-section">
      <h3 class="section-title">Daftar Jenis Ujian</h3>
    </div>

    {{-- Tabel --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Jenis Ujian</th>
            <th>Guru</th>
            <th>Mapel</th>
            <th>Jumlah Soal</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($jenisUjians as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_jenis_ujian }}</td>
              <td>{{ $item->guru->user->name ?? '-' }}</td>
              <td>{{ $item->guru->mapel->nama_mapel ?? '-' }}</td>
              <td>{{ $item->soals->count() }} soal</td>

              <td>
                <div class="action-buttons">
                  <a href="{{ route('soal.detail', $item->id) }}" class="btn btn-info">
                    Lihat Soal
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr class="empty-row">
              <td colspan="6">Belum ada Jenis Ujian.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  {{-- CSS --}}
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .top-section {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 6px;
      margin: 0;
    }

    /* Notifikasi */
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    /* Tabel */
    .table-container { overflow-x: auto; }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      color: #333;
    }

    thead {
      background-color: #b91c1c;
      color: white;
      text-transform: uppercase;
      font-size: 13px;
    }

    th, td {
      border: 1px solid #f3c5c5;
      padding: 10px 12px;
      text-align: center;
    }

    td { text-align: left; }

    tbody tr:nth-child(even) { background-color: #f9f9f9; }
    tbody tr:hover { background-color: #fde8e8; }

    /* Tombol Aksi */
    .action-buttons {
      display: flex;
      justify-content: center;
    }

    .btn {
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: .2s;
      border: none;
    }

    .btn-info {
      background-color: #dbeafe;
      color: #1d4ed8;
    }
    .btn-info:hover {
      background-color: #bfdbfe;
      color: #1e40af;
    }

    /* Tidak ada data */
    .empty-row td {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }
  </style>

</x-app-layout>
