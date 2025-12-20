<x-app-layout>

  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .card {
      background-color: #fff; border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      border: 1px solid #f1dada; padding: 25px; transition: 0.3s ease;
    }
    .header-title {
      font-size: 1.4rem; font-weight: 700; color: #b91c1c;
      border-bottom: 3px solid #b91c1c; padding-bottom: 8px; margin-bottom: 20px;
    }
    .alert-success {
      background-color: #d1fae5; border-left: 4px solid #10b981;
      color: #065f46; padding: 10px; border-radius: 6px; margin-bottom: 15px;
    }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    thead { background-color: #b91c1c; color: white; }
    th, td { border: 1px solid #f3c5c5; padding: 10px 12px; text-align: left; }
    th { text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px; text-align: center; }
    tbody tr:hover { background-color: #fde8e8; transition: 0.2s; }
    .empty { text-align: center; color: #9ca3af; font-style: italic; padding: 15px 0; }
    .btn-detail {
      background-color: #2563eb; color: white; padding: 6px 10px;
      border-radius: 6px; font-size: 13px; transition: 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-detail:hover { background-color: #1e40af; }
    .btn-rekap {
      background-color: #059669; color: white; padding: 8px 16px;
      border-radius: 6px; font-size: 14px; transition: 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-rekap:hover { background-color: #047857; }
    .header-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif

      <div class="card">
        <div class="header-actions">
          <h3 class="header-title" style="margin-bottom: 0;">
            {{ $jadwal->mapel->nama_mapel ?? 'Mapel' }} - {{ $jadwal->kelas->nama_kelas ?? '' }}
            <span class="text-gray-500 text-sm font-normal">
              ({{ ucfirst($jadwal->hari) }} {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
            </span>
          </h3>
        </div>

        @if($tanggalList->isEmpty())
          <p class="empty">Belum ada data presensi.</p>
        @else
          <table>
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tanggalList as $tanggal)
                <tr>
                  <td class="text-center">
                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                  </td>
                  <td class="text-center">
                    <a href="{{ route('presensi.detail', ['jadwal' => $jadwal->id, 'tanggal' => $tanggal]) }}"
                      class="btn-detail">Lihat Detail</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>

    </div>
  </div>

</x-app-layout>