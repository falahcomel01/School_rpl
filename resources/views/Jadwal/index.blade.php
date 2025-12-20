<x-app-layout>
  <style>
    table { width:100%; border-collapse:collapse; margin-top:15px }
    thead { background:#b91c1c; color:white }
    th,td { border:1px solid #f3c5c5; padding:10px; text-align:center }
    tr:hover { background:#fde8e8 }
    .group-header { background:#fee2e2; font-weight:bold; text-align:left }
    .btn-edit{background:#fee2e2;border:1px solid #fca5a5;padding:5px 10px;border-radius:6px}
    .btn-delete{background:#dc2626;color:white;padding:5px 10px;border-radius:6px}
    .empty{text-align:center;color:#9ca3af;font-style:italic}
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
    }

    .btn-add:hover {
      background-color: #b91c1c;
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
      padding: 5px 10px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      transition: 0.2s;
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
    }

    .btn-delete:hover {
      background-color: #b91c1c;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .empty {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
      padding: 15px 0;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 6px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="card">

        <div style="display:flex;justify-content:space-between;align-items:center;">
          <h3 class="header-title">Daftar Jadwal</h3>
          @can('create jadwal')
            <a href="{{ route('jadwal.create') }}" class="btn-add">+ Tambah Jadwal</a>
          @endcan
        </div>

        @if(session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
          <table>
            <thead>
              <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mapel</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                @can('edit jadwal')
                  <th>Aksi</th>
                @endcan
              </tr>
            </thead>

            <tbody>
              @forelse($jadwals as $hari => $items)

    
                {{-- LIST DATA TANPA KOLOM HARI --}}
                @foreach($items as $jadwal)
                  <tr>
                    <td>{{ $jadwal->hari }} </td> 
                    <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td>{{ $jadwal->mapel->nama_mapel ?? '-' }}</td>
                    <td>{{ $jadwal->guru->user->name ?? '-' }}</td>
                    <td>{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $jadwal->kelas->jurusan->nama_jurusan ?? '-' }}</td>

                    @can('edit jadwal')
                      <td>
                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                              style="display:inline" onsubmit="return confirm('Hapus jadwal ini?')">
                          @csrf @method('DELETE')
                          <button class="btn-delete">Hapus</button>
                        </form>
                      </td>
                    @endcan
                  </tr>
                @endforeach

              @empty
                <tr>
                  <td colspan="@can('edit jadwal') 8 @else 7 @endcan" class="empty">Tidak ada jadwal</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>
