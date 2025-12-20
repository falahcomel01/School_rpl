<x-app-layout>
  <div class="container">

      {{-- Top Section --}}
      <div class="top-section">
          <h3 class="section-title">Daftar Jurusan</h3>
          <a href="{{ route('jurusan.create') }}" class="btn btn-add">+ Tambah Jurusan</a>
      </div>

      {{-- Notifikasi sukses --}}
      @if (session('success'))
          <div class="alert-success">
              {{ session('success') }}
          </div>
      @endif

      {{-- Tabel --}}
      <div class="table-container">
          <table>
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Jurusan</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($jurusan as $i => $j)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $j->nama_jurusan }}</td>
                          <td>
                              <div class="action-buttons">
                                  <a href="{{ route('jurusan.edit', $j->id) }}" class="btn btn-edit">Edit</a>

                                  <form action="{{ route('jurusan.destroy', $j->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-delete">Hapus</button>
                                  </form>
                              </div>
                          </td>
                      </tr>
                  @empty
                      <tr class="empty-row">
                          <td colspan="3">Tidak ada data jurusan.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>

      {{-- Pagination (jika pakai paginate) --}}
      @if(method_exists($jurusan, 'links'))
          <div class="pagination">
              {{ $jurusan->links() }}
          </div>
      @endif

  </div>

  {{-- CSS dari Wali Kelas, sudah disesuaikan --}}
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin-bottom: 25px;
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
      display: inline-block;
      padding-bottom: 6px;
      margin: 0;
    }

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

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn-edit {
      background-color: #fff;
      border: 1px solid #b91c1c;
      color: #b91c1c;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
    }

    .btn-edit:hover {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
    }

    .btn-delete:hover {
      background-color: #991b1b;
    }

    .empty-row td {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }

    .pagination {
      margin-top: 20px;
      text-align: center;
      font-size: 13px;
      color: #6b7280;
    }
  </style>
</x-app-layout>
