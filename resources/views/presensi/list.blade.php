<x-app-layout>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .card {
    background: #fff;
    border: 1px solid #f1dada;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,.08);
    padding: 25px;
    transition: .3s;
  }

  .header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .header-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #b91c1c;
    border-bottom: 3px solid #b91c1c;
    padding-bottom: 8px;
    margin: 0;
  }

  .btn-rekap {
    display: inline-block;
    background: #dc2626;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: .2s;
  }

  .btn-rekap:hover {
    background: #b91c1c;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
  }

  thead {
    background: #b91c1c;
    color: #fff;
  }

  th, td {
    border: 1px solid #f3c5c5;
    padding: 10px 12px;
  }

  th {
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: .5px;
    text-align: center;
  }

  tbody tr:hover {
    background: #fde8e8;
    transition: .2s;
  }

  .alert-success {
    background: #d1fae5;
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

  .btn-link {
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 6px;
    transition: .2s;
  }

  .btn-presensi {
    color: #2563eb;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
  }

  .btn-presensi:hover {
    background: #dbeafe;
  }

  .btn-detail {
    color: #16a34a;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
  }

  .btn-detail:hover {
    background: #dcfce7;
  }

  .action-buttons {
    display: flex;
    justify-content: center;
    gap: 6px;
  }
</style>

<div class="py-10">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="card">

      {{-- Header dengan Tombol Rekap --}}
      <div class="header-section">
        <h3 class="header-title">Daftar Jadwal Presensi</h3>
        <a href="{{ route('presensi.rekap') }}" class="btn-rekap">
          Lihat Rekap
        </a>
      </div>

      @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif

      <div class="overflow-x-auto">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Mapel</th>
              <th>Guru</th>
              <th>Kelas</th>
              <th>Jurusan</th>
              <th>Hari</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($jadwals as $no => $jadwal)
              <tr>
                <td class="text-center">{{ $no + 1 }}</td>
                <td>{{ $jadwal->mapel->nama_mapel ?? '-' }}</td>
                <td>{{ $jadwal->guru->user->name ?? '-' }}</td>
                <td>{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $jadwal->kelas->jurusan->nama_jurusan ?? '-' }}</td>
                <td class="capitalize text-center">{{ $jadwal->hari }}</td>

                <td>
                  <div class="action-buttons">
                    @can('create presensisiswa')
                      <a href="{{ route('presensi.create', ['jadwal_id' => $jadwal->id]) }}"
                         class="btn-link btn-presensi">Presensi</a>
                    @endcan

                    <a href="{{ route('presensi.show', $jadwal->id) }}"
                       class="btn-link btn-detail">Detail</a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="empty">Tidak ada jadwal.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</x-app-layout>