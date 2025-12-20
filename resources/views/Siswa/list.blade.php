<x-app-layout>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 25px;
      transition: 0.3s ease;
    }

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 20px;
    }

    .btn-add {
      background-color: #dc2626;
      color: #fff;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: 0.2s;
      border: none;
      cursor: pointer;
    }

    .btn-add:hover {
      background-color: #b91c1c;
    }

    .btn-export {
      background-color: #16a34a;
    }

    .btn-export:hover {
      background-color: #15803d;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    thead {
      background-color: #b91c1c;
      color: white;
    }

    th,
    td {
      border: 1px solid #f3c5c5;
      padding: 10px 12px;
      text-align: center;
    }

    th {
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.5px;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: 0.2s;
    }

    .btn {
      display: inline-block;
      font-size: 13px;
      padding: 6px 10px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
    }

    .btn-edit {
      background-color: #fee2e2;
      border: 1px solid #fca5a5;
      color: #b91c1c;
    }

    .btn-edit:hover {
      background-color: #fecaca;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
      border: none;
      cursor: pointer;
    }

    .btn-delete:hover {
      background-color: #991b1b;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .search-bar {
      display: flex;
      gap: 8px;
      margin-bottom: 15px;
    }

    .search-input {
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 6px 10px;
      width: 250px;
    }

    .search-btn {
      background-color: #dc2626;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 6px 14px;
      cursor: pointer;
      transition: 0.2s;
      font-weight: 600;
    }

    .search-btn:hover {
      background-color: #b91c1c;
    }

    .empty {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
      padding: 15px 0;
    }

    .top-actions {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .import-form {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .file-input {
      border: 1px solid #f3c5c5;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 13px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-3">
          <h3 class="header-title">Daftar Siswa</h3>

          <div class="top-actions">
            {{-- Tombol Export --}}
            <a href="{{ route('siswa.export') }}" class="btn-add btn-export">
              Export Siswa
            </a>

            {{-- Form Import --}}
            <form action="{{ route('siswa.import') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="import-form">
              @csrf
              <input type="file" name="file" required class="file-input">
              <button type="submit" class="btn-add">Import</button>
            </form>

            {{-- Tombol Tambah Siswa --}}
            @can('create siswa')
              <a href="{{ route('siswa.create') }}" class="btn-add">
                + Tambah Siswa
              </a>
            @endcan
          </div>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
          <div class="alert-error">{{ session('error') }}</div>
        @endif

        {{-- Pencarian --}}
        <form method="GET" class="search-bar">
          <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nama / NIS..."
            class="search-input"
          >
          <button type="submit" class="search-btn">Cari</button>
        </form>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th>
                @can('edit siswa')
                  <th>Aksi</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($siswa as $index => $user)
                <tr>
                  <td>{{ $siswa->firstItem() + $index }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email ?? '-' }}</td>
                  <td>{{ $user->siswa?->kelas?->nama_kelas ?? '-' }}</td>
                  <td>{{ $user->siswa?->kelas?->jurusan?->nama_jurusan ?? '-' }}</td>
                  <td>{{ $user->siswa?->jenis_kelamin ?? '-' }}</td>
                  <td>
                    <div class="flex justify-center gap-2">
                      @can('edit siswa')
                        <a href="{{ route('siswa.edit', $user->id) }}" class="btn btn-edit">Edit</a>
                      @endcan

                      @can('delete siswa')
                        <form action="{{ route('siswa.destroy', $user->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus siswa ini? Data tidak bisa dipulihkan!')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                      @endcan
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="empty">Tidak ada data siswa.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
          {{ $siswa->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>