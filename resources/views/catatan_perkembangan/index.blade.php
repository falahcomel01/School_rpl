<x-app-layout>
  <div class="container">
    <div class="top-section">
      <h3 class="section-title">Catatan Perkembangan</h3>

      @can('create catatan_perkembangan')
        @if(isset($walikelas))
          <a href="{{ route('catatan_perkembangan.create') }}" class="btn btn-add">+ Tambah</a>
        @endif
      @endcan
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Siswa</th>
          <th>Semester</th>
          <th>Tahun</th>
          <th>Catatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($catatan as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->siswa->user->name }}</td>
            <td>{{ ucfirst($item->semester) }}</td>
            <td>{{ $item->tahun_ajaran }}</td>
            <td>
              <strong>Akademik:</strong> {{ Str::limit($item->catatan_akademik, 50) }}<br>
              <strong>Non:</strong> {{ Str::limit($item->catatan_non_akademik, 50) }}
            </td>
            <td>
              <a href="{{ route('catatan_perkembangan.show', $item->id) }}">Detail</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6">Belum ada data</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- ========================= STYLE ========================= --}}
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 1100px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .top-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 6px;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #991b1b;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .btn-add {
      background-color: #b91c1c;
      color: #fff;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
    }
    .btn-add:hover { background-color: #991b1b; }

    .table-container { overflow-x: auto; }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    thead {
      background-color: #b91c1c;
      color: white;
    }

    th, td {
      border: 1px solid #f3c5c5;
      padding: 10px;
      text-align: center;
    }

    tbody tr:nth-child(even) { background-color: #f9f9f9; }
    tbody tr:hover { background-color: #fde8e8; }

    /*	----- BLOK CATATAN -----	*/
    .catatan-kolom {
      text-align: left;
      padding: 12px;
      min-width: 250px;
    }

    .jenis-wrapper {
      background: #fff7f7;
      border: 1px solid #f3c5c5;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 10px;
    }

    .jenis-title {
      color: #b91c1c;
      font-size: 13px;
      font-weight: bold;
    }

    .jenis-text {
      margin-top: 5px;
      color: #374151;
      font-size: 13px;
      line-height: 1.4;
      white-space: pre-wrap;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 6px 12px;
      font-size: 12px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      border: none;
      transition: 0.2s;
    }

    .btn-detail { background-color: #2563eb; color: white; }
    .btn-detail:hover { background-color: #1d4ed8; }

    .btn-edit {
      background-color: #fff;
      border: 1px solid #b91c1c;
      color: #b91c1c;
    }
    .btn-edit:hover {
      background-color: #b91c1c;
      color: white;
    }

    .btn-delete { background-color: #dc2626; color: white; }
    .btn-delete:hover { background-color: #991b1b; }

    .empty-row td {
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }

    .pagination { margin-top: 20px; text-align: center; }
  </style>
</x-app-layout>
