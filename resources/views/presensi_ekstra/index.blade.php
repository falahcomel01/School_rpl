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

  .btn-tambah {
    display: inline-block;
    background: #2563eb;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: .2s;
    margin-left: 10px;
  }

  .btn-tambah:hover {
    background: #1d4ed8;
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

  .alert-error {
    background: #fee2e2;
    border-left: 4px solid #dc2626;
    color: #7f1d1d;
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

  .badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
  }

  .badge-info {
    background: #dbeafe;
    color: #1e40af;
  }

  .badge-warning {
    background: #fef3c7;
    color: #92400e;
  }
</style>

<div class="py-10">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="card">

      {{-- Header dengan Tombol --}}
      <div class="header-section">
        <h3 class="header-title">Presensi Ekstrakurikuler</h3>
      </div>

      @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif

      @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
      @endif

      <div class="overflow-x-auto">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Ekstrakurikuler</th>
              <th>Pembina</th>
              <th>Jadwal</th>
              <th>Tempat</th>
              <th>Peserta</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($ekstras as $no => $extra)
              <tr>
                <td class="text-center">{{ $no + 1 }}</td>
                <td>
                  <strong>{{ $extra->nama_extra }}</strong>
                  @if($extra->deskripsi)
                    <br><small style="color: #6b7280;">{{ Str::limit($extra->deskripsi, 50) }}</small>
                  @endif
                </td>
                <td>{{ $extra->pembina->user->name ?? '-' }}</td>
                <td class="text-center">{{ $extra->jadwal ?? '-' }}</td>
                <td class="text-center">{{ $extra->tempat ?? '-' }}</td>
                <td class="text-center">
                  <span class="badge badge-info">
                    {{ $extra->extraPeserta->count() ?? 0 }} / {{ $extra->kuota }} siswa
                  </span>
                </td>

                <td>
                  <div class="action-buttons">
                    @can('create presensisiswa')
                      <a href="{{ route('presensi_ekstra.create', ['ekstrakurikuler_id' => $extra->id]) }}"
                         class="btn-link btn-presensi">Presensi</a>
                    @endcan

                    <a href="{{ route('presensi_ekstra.show', $extra->id) }}"
                       class="btn-link btn-detail">Detail</a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="empty">Tidak ada data ekstrakurikuler.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</x-app-layout>