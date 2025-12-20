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
      <h3 class="section-title">Data Orang Tua</h3>
      <a href="{{ route('orangtua.create') }}" class="btn btn-danger">
        + Tambah Orang Tua
      </a>
    </div>

    {{-- Tabel --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Orang Tua</th>
            <th>Email</th>
            <th>Anak</th>
            <th>Kelas</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($orangtua as $ortu)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $ortu->user->name ?? '-' }}</td>
              <td>{{ $ortu->user->email ?? '-' }}</td>
              <td>{{ $ortu->siswa->user->name ?? '-' }}</td>
              <td>{{ $ortu->siswa->kelas->nama_kelas ?? '-' }}</td>
              <td class="text-center">

                {{-- Tombol Edit --}}
                <a href="{{ route('orangtua.edit', $ortu->id) }}"
                   class="btn btn-sm btn-secondary">
                  Edit
                </a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('orangtua.destroy', $ortu->id) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus data ini?')"
                      class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">
                    Hapus
                  </button>
                </form>

              </td>
            </tr>
          @empty
            <tr class="empty-row">
              <td colspan="6">Tidak ada data.</td>
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
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
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

    /* Tombol */
    .btn {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: 0.2s;
      border: none;
    }

    .btn-danger {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-danger:hover {
      background-color: #991b1b;
    }

    .btn-secondary {
      background-color: #6b7280;
      color: #fff;
    }

    .btn-secondary:hover {
      background-color: #4b5563;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 13px;
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

    td {
      text-align: left;
    }

    .text-center {
      text-align: center !important;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: background-color 0.2s ease;
    }

    /* Tidak ada data */
    .empty-row td {
      text-align: center;
      padding: 20px;
      color: #9ca3af;
      background-color: #f9fafb;
      font-style: italic;
    }

    /* Utility */
    .d-inline {
      display: inline;
    }
  </style>

</x-app-layout>
