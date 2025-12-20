<x-app-layout>
  <div class="container">
<div class="section-title">
        Daftar Pembina Ekstra
    </div>
    {{-- Notifikasi sukses --}}
    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Notifikasi error --}}
    @if (session('error'))
      <div class="alert-error">
        {{ session('error') }}
      </div>
    @endif

    {{-- Tombol Tambah Pembina --}}
    <div class="flex justify-end mb-4">
      <a href="{{ route('pembina.create') }}" class="btn-add">
        + Tambah Pembina
      </a>
    </div>

    <div class="top-bar">
      <form method="GET" action="{{ route('pembina.index') }}" class="search-form">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari nama, username, atau email..."
               class="search-input">
        <button type="submit" class="btn btn-search">Cari</button>
        @if(request('search'))
          <a href="{{ route('pembina.index') }}" class="btn-reset">Reset</a>
        @endif
      </form>
    </div>

    {{-- Tabel Data Pembina --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pembina as $index => $item)
            <tr>
              <td>{{ $pembina->firstItem() + $index }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->username }}</td>
              <td>{{ $item->email ?? '-' }}</td>
              <td>{{ $item->pembina->jenis_kelamin ?? '-' }}</td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('pembina.edit', $item->id) }}" class="btn btn-edit">Edit</a>

                  <form action="{{ route('pembina.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Hapus pembina ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr class="empty-row">
              <td colspan="6">
                @if(request('search'))
                  Tidak ada pembina ditemukan dengan kata kunci "{{ request('search') }}".
                @else
                  Belum ada data pembina.
                @endif
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination">
      {{ $pembina->appends(['search' => request('search')])->links() }}
    </div>
  </div>

  <style>
    /* Tampilan Umum */
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
.section-title {
    font-size: 18px;
    font-weight: 700;
    color: #b91c1c;
    margin-bottom: 20px;
    border-left: 4px solid #b91c1c;
    padding-left: 10px;
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

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #ef4444;
      color: #991b1b;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    /* Bar Atas */
    .top-bar {
      display: flex;
      justify-content: flex-start;
      margin-bottom: 25px;
      flex-wrap: wrap;
      gap: 8px;
    }

    .search-form {
      display: flex;
      width: 100%;
      max-width: 500px;
      gap: 6px;
    }

    .search-input {
      flex: 1;
      padding: 9px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
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
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-search:hover {
      background-color: #b91c1c;
    }

    .btn-reset {
      background-color: #6b7280;
      color: white;
      padding: 9px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: 0.2s ease;
    }

    .btn-reset:hover {
      background-color: #4b5563;
    }

    /* Tabel Data */
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
      text-decoration: none;
      cursor: pointer;
      transition: 0.2s;
      text-align: center;
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

    /* Responsif tambahan untuk tombol aksi di mobile */
    @media (max-width: 768px) {
      .action-buttons {
        flex-direction: column;
        align-items: center;
      }

      .btn {
        width: 100%;
        max-width: 120px;
      }
    }
  </style>
</x-app-layout>