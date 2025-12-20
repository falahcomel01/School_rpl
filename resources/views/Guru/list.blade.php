<x-app-layout>
  <div class="container">

    {{-- Notifikasi sukses --}}
    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tombol Tambah Guru --}}
<div class="flex justify-end mb-4">
  <a href="{{ route('guru.create') }}" class="btn-add">
    + Tambah Guru
  </a>
</div>

    <div class="top-bar">
      <form method="GET" action="{{ route('guru.index') }}" class="search-form">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}"
               placeholder="Cari nama atau NIP..." 
               class="search-input">
        <button type="submit" class="btn btn-search">Cari</button>
      </form>
    </div>

    {{-- Tabel Data Guru --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Mapel</th>      {{-- ✔ Tambahan sesuai controller --}}
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($guru as $index => $item)
            <tr>
              <td>{{ $guru->firstItem() + $index }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->username }}</td>

              {{-- Mapel --}}
              <td>
                {{ $item->guru->mapel->nama_mapel ?? '-' }}
              </td>

              {{-- Jenis Kelamin --}}
              <td>{{ $item->guru->jenis_kelamin ?? '-' }}</td>

              <td>
                <div class="action-buttons">
                  <a href="{{ route('guru.edit', $item->id) }}" class="btn btn-edit">Edit</a>

                  <form action="{{ route('guru.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data guru ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr class="empty-row">
              <td colspan="6">Tidak ada data guru.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination">
      {{ $guru->links() }}
    </div>
  </div>

    {{--Pagination --}}
    <div class="pagination">
      {{ $guru->links() }}
    </div>
  </div>

  <style>
    /*Tampilan Umum */
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

    .page-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin-bottom: 25px;
    }
    .btn-add {
  background-color: #b91c1c;
  color: white;
  padding: 9px 14px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  transition: 0.2s ease;
  border: 1px solid #b91c1c;
}

.btn-add:hover {
  background-color: #fff;
  color: #b91c1c;
}


    /*Notifikasi */
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    /*Bar Atas */
    .top-bar {
      display: flex;
      justify-content: flex-start;
      margin-bottom: 25px;
    }

    .search-form {
      display: flex;
      width: 100%;
      max-width: 500px;
    }

    .search-input {
      flex: 1;
      padding: 9px 12px;
      border: 1px solid #ccc;
      border-radius: 6px 0 0 6px;
      outline: none;
      font-size: 14px;
      transition: border 0.2s ease;
    }

    .search-input:focus {
      border-color: #b91c1c;
    }

    .btn-search {
      background-color: #dc2626;
      color: white;
      border: none;
      padding: 9px 18px;
      border-radius: 0 6px 6px 0;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-search:hover {
      background-color: #b91c1c;
    }

    /*Tabel Data */
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

    td {
      color: #333;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: background-color 0.2s ease;
    }

    /*Tombol Aksi */
    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
    }

    .btn {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: 0.2s;
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

    /*Tidak Ada Data */
    .empty-row td {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }

    /*Pagination */
    .pagination {
      margin-top: 20px;
      text-align: center;
      font-size: 13px;
      color: #6b7280;
    }
  </style>
</x-app-layout>
