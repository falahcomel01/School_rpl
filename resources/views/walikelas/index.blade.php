<x-app-layout>


  <div class="container">
    {{-- Judul Section --}}
    <div class="top-section">
      <h3 class="section-title">Daftar Wali Kelas</h3>
       @can('edit walikelas')
      <a href="{{ route('walikelas.create') }}" class="btn btn-add">+ Tambah Wali Kelas</a>
       @endcan
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tabel Data Wali Kelas --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            @canany(['edit walikelas'])
            <th>Aksi</th>
            @endcanany
          </tr>
      <thead>
</thead>
<tbody>
  @forelse($walikelas as $wk)
    <tr>
      <td>{{ $loop->iteration + ($walikelas->currentPage() - 1) * $walikelas->perPage() }}</td>
      <td>{{ $wk->guru->user->name ?? '-' }}</td>
      <td>{{ $wk->kelas->nama_kelas ?? '-' }}</td>
      <td>{{ $wk->kelas->jurusan->nama_jurusan ?? '-' }}</td>
      @canany(['edit walikelas'])
        <td>
          <div class="action-buttons">
            <a href="{{ route('walikelas.edit', $wk->id) }}" class="btn btn-edit">Edit</a>
            <form action="{{ route('walikelas.destroy', $wk->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-delete">Hapus</button>
            </form>
          </div>
        </td>
      @endcanany
    </tr>
  @empty
    <tr class="empty-row">
      {{-- Kalau user bisa edit --}}
      @canany(['edit walikelas'])
        <td colspan="5">Tidak ada data wali kelas.</td>
      @else
        <td colspan="4">Tidak ada data wali kelas.</td>
      @endcanany
    </tr>
  @endforelse
</tbody>

      </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination">
      {{ $walikelas->links() }}
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

    .page-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin-bottom: 25px;
    }

    /* === Judul Section (Tambahan Baru) === */
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
      display: inline-block;
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

    /* Tombol Tambah */
    .btn-add {
      background-color: #b91c1c;
      color: #fff;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      transition: background-color 0.2s;
    }

    .btn-add:hover {
      background-color: #991b1b;
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

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: background-color 0.2s ease;
    }

    /* Tombol Aksi */
    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-detail:hover {
      background-color: #1d4ed8;
    }

    .btn-edit {
      background-color: #fff;
      border: 1px solid #b91c1c;
      color: #b91c1c;
    }

    .btn-edit:hover {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
      border: none;
    }

    .btn-delete:hover {
      background-color: #991b1b;
    }

    /* Tidak Ada Data */
    .empty-row td {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }

    /* Pagination */
    .pagination {
      margin-top: 20px;
      text-align: center;
      font-size: 13px;
      color: #6b7280;
    }
  </style>
</x-app-layout>
