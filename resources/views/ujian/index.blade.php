<x-app-layout>

  <div class="container">

    {{-- Notifikasi --}}
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tombol Tambah --}}
    <div class="top-section">
      <a href="{{ route('ujian.create') }}" class="btn btn-danger">
        <i class="fa-solid fa-plus"></i> Buat Ujian Baru
      </a>
    </div>

    {{-- Tabel --}}
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Mapel</th>
            <th>Guru</th>
            <th>Jenis Ujian</th>
            <th>Paket</th>
            <th>Jumlah Soal</th>
            <th>Durasi</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($ujians as $ujian)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $ujian->kelas->nama_kelas }}</td>
              <td>
                @if($ujian->guru && $ujian->guru->mapel)
                  {{ $ujian->guru->mapel->nama_mapel }}
                @else
                  <span class="text-muted">Belum diset</span>
                @endif
              </td>
              <td>
                @if($ujian->guru && $ujian->guru->user)
                  {{ $ujian->guru->user->name }}
                @else
                  <span class="text-muted">Belum diset</span>
                @endif
              </td>
              <td class="fw-semibold">{{ strtoupper($ujian->jenis_ujian) }}</td>
              <td class="text-center">
                @if($ujian->tipe_paket === 'random')
                  <span class="badge badge-random">Random</span>
                @else
                  <span class="badge badge-paket">Paket</span>
                @endif
              </td>
              <td class="text-center">{{ $ujian->jumlah_soal }} Soal</td>
              <td class="text-center">{{ $ujian->durasi_menit }} Menit</td>
              <td>
                <small class="d-block">
                  Mulai: {{ \Carbon\Carbon::parse($ujian->tanggal_mulai)->format('d M Y, H:i') }}
                </small>
                <small class="d-block">
                  Selesai: {{ \Carbon\Carbon::parse($ujian->tanggal_selesai)->format('d M Y, H:i') }}
                </small>
              </td>

              <td class="text-center">
                @php
                  $statusClass = match($ujian->status_real) {
                    'aktif' => 'badge-aktif',
                    'draft' => 'badge-draft',
                    'selesai' => 'badge-selesai',
                    'nonaktif' => 'badge-nonaktif',
                    default => 'badge-default'
                  };
                @endphp
                <span class="badge {{ $statusClass }}">
                  {{ ucfirst($ujian->status_real) }}
                </span>
              </td>

              <td class="text-center">
                <div class="action-icons">
                  <a href="{{ route('ujian.atur-soal', $ujian->id) }}" class="icon-btn" title="Atur Soal">
                    <i class="fa-solid fa-list-check"></i>
                  </a>
                  <a href="{{ route('ujian_siswa.daftar_peserta', $ujian->id) }}" class="icon-btn" title="Hasil Siswa">
                    <i class="fa-solid fa-chart-line"></i>
                  </a>
                  <a href="{{ route('ujian.edit', $ujian->id) }}" class="icon-btn" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <form action="{{ route('ujian.destroy', $ujian->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ujian ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn btn-delete" title="Hapus">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="11" class="empty-cell">
                <i class="fa-solid fa-circle-info me-2"></i> Belum ada ujian dibuat.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 1200px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    /* Notifikasi */
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px 16px;
      border-radius: 6px;
      margin-bottom: 24px;
      font-size: 14px;
    }

    /* Tombol Atas */
    .top-section {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 24px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
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
      color: white;
    }
    .btn-danger:hover {
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
      padding: 12px 10px;
      text-align: center;
    }

    td {
      text-align: left;
    }

    .text-center {
      text-align: center !important;
    }

    .fw-semibold {
      font-weight: 600;
    }

    .text-muted {
      color: #9ca3af;
      font-style: italic;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #fde8e8;
    }

    /* Badge */
    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 600;
      text-transform: capitalize;
    }

    .badge-random {
      background-color: #dbeafe;
      color: #1e40af;
    }
    .badge-paket {
      background-color: #fef9c3;
      color: #92400e;
    }
    .badge-aktif {
      background-color: #dcfce7;
      color: #166534;
    }
    .badge-draft {
      background-color: #e5e7eb;
      color: #4b5563;
    }
    .badge-selesai {
      background-color: #f3f4f6;
      color: #374151;
    }
    .badge-nonaktif {
      background-color: #fee2e2;
      color: #b91c1c;
    }
    .badge-default {
      background-color: #ffedd5;
      color: #c2410c;
    }

    /* Ikon Aksi */
    .action-icons {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .icon-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background-color: #f1f1f1;
      color: #555;
      text-decoration: none;
      transition: 0.2s;
      font-size: 14px;
      border: 1px solid #ddd;
    }

    .icon-btn:hover {
      background-color: #e0e0e0;
      color: #333;
    }

    .btn-delete {
      background-color: #fee2e2;
      color: #b91c1c;
      border-color: #fecaca;
    }

    .btn-delete:hover {
      background-color: #fecaca;
      color: #991b1b;
    }

    /* Empty */
    .empty-cell {
      text-align: center;
      padding: 24px;
      color: #9ca3af;
      font-style: italic;
    }

    /* Utility */
    .d-inline {
      display: inline;
    }

    small {
      font-size: 12px;
      color: #666;
    }
  </style>

</x-app-layout>