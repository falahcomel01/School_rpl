{{-- FILE 1: resources/views/jenis-ujian/index.blade.php --}}
<x-app-layout>
  <div class="container">

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Judul + Tombol Tambah --}}
    <div class="top-section">
      <h3 class="section-title">Data Jenis Ujian</h3>

      
        <a href="{{ route('jenis-ujian.create') }}" class="btn-add">+ Tambah Jenis Ujian</a>
      
    </div>

    {{-- Tabel --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Jenis Ujian</th>
            <th>Guru</th>
            <th>Mapel</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($jenisUjians as $jenisUjian)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $jenisUjian->nama_jenis_ujian }}</td>
              <td>{{ $jenisUjian->guru->user->name }}</td>
              <td>{{ $jenisUjian->guru->mapel->nama_mapel ?? '-' }}</td>

              <td>
                <div class="action-buttons">
                  <a href="{{ route('jenis-ujian.edit', $jenisUjian->id) }}" class="btn btn-edit">Edit</a>

                  <form action="{{ route('jenis-ujian.destroy', $jenisUjian->id) }}" method="POST"
                        onsubmit="return confirm('Hapus Jenis Ujian ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>

          @empty
            <tr class="empty-row">
              <td colspan="5">Belum ada Jenis Ujian.</td>
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

    .page-title {
      font-size: 1.6rem;
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

    /* Tombol tambah */
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
