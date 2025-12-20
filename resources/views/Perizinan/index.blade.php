<x-app-layout>
  <style>
    body {
      font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fdfcfc;
    }

    .card {
      background: #ffffff;
      border-radius: 14px;
      border: 1px solid #f3d4d4;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      padding: 22px;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 14px;
    }

    thead {
      background: linear-gradient(90deg, #b91c1c, #ef4444);
      color: white;
    }

    th, td {
      border: 1px solid #f2bcbc;
      padding: 11px 13px;
      font-size: 14px;
    }

    th {
      font-weight: 600;
      text-transform: capitalize;
      text-align: center;
    }

    tbody tr:hover {
      background-color: #fff6f6;
      transition: 0.25s;
    }

    .btn-create {
      background: linear-gradient(90deg, #dc2626, #b91c1c);
      color: #fff;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.25s;
      box-shadow: 0 2px 6px rgba(220, 38, 38, 0.3);
    }

    .btn-create:hover {
      background: linear-gradient(90deg, #b91c1c, #991b1b);
      box-shadow: 0 3px 8px rgba(185, 28, 28, 0.35);
    }

    .empty {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
      padding: 20px 0;
    }

    .box-tag {
      background: rgba(255, 255, 255, 0.8);
      border: 1px solid #f3caca;
      padding: 6px 10px;
      border-radius: 8px;
      font-weight: 500;
      display: inline-block;
      min-width: 80px;
      text-align: center;
    }

    .status-izin { color: #92400e; }
    .status-sakit { color: #1e40af; }
    .status-lain { color: #374151; }

    .link-bukti {
      color: #2563eb;
      text-decoration: none;
      font-weight: 500;
    }

    .link-bukti:hover {
      text-decoration: underline;
      color: #1d4ed8;
    }

    .btn-action-group {
      display: flex;
      gap: 8px;
      justify-content: center;
      align-items: center;
    }

    .btn-action {
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      border: none;
    }

    .btn-success {
      background-color: #dcfce7;
      color: #166534;
      border: 1px solid #86efac;
    }

    .btn-success:hover {
      background-color: #86efac;
      color: white;
    }

    .btn-danger {
      background-color: #fee2e2;
      color: #b91c1c;
      border: 1px solid #fca5a5;
    }

    .btn-danger:hover {
      background-color: #fca5a5;
      color: white;
    }
  </style>

  <div class="p-6">

    {{-- Tombol Ajukan Izin --}}
    <div class="flex justify-end mb-4">
      <a href="{{ route('perizinan.create') }}" class="btn-create">+ Ajukan Izin</a>
    </div>

    @if (session('success'))
      <div class="bg-green-100 text-green-700 border border-green-400 rounded p-2 mb-4">
        {{ session('success') }}
      </div>
    @endif

    <div class="card">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Validasi</th>
            @can('validasi izin')
            <th>Aksi</th>
            @endcan
          </tr>
        </thead>

        <tbody>
          @forelse ($perizinans as $i => $izin)
            <tr>
              <td style="text-align: center;">{{ $i + 1 }}</td>
              <td>{{ $izin->user->name }}</td>
              <td style="text-align: center;">{{ $izin->tanggal_mulai }}</td>
              <td style="text-align: center;">{{ $izin->tanggal_selesai }}</td>

              <td style="text-align: center;">
                <span class="box-tag 
                  @if ($izin->status == 'izin') status-izin 
                  @elseif ($izin->status == 'sakit') status-sakit 
                  @else status-lain @endif">
                  {{ ucfirst($izin->status) }}
                </span>
              </td>

              <td style="text-align: center;">
                @if ($izin->file_surat)
                  <span class="box-tag">
                    <a href="{{ route('perizinan.file', $izin->id) }}" target="_blank" class="link-bukti">Lihat</a>
                  </span>
                @else
                  <span class="box-tag">-</span>
                @endif
              </td>

              <td style="text-align: center;">
                <span class="box-tag 
                  @if ($izin->validasi == 'pending') text-yellow-600
                  @elseif ($izin->validasi == 'disetujui') text-green-600
                  @else text-red-600 @endif">
                  {{ ucfirst($izin->validasi) }}
                </span>
              </td>

              @can('validasi izin')
              <td style="text-align: center;">
                @if ($izin->validasi == 'pending')
                  <div class="btn-action-group">
                    <form action="{{ route('perizinan.validasi', $izin->id) }}" method="POST" style="margin: 0;">
                      @csrf
                      <input type="hidden" name="validasi" value="disetujui">
                      <button type="submit" class="btn-action btn-success">✓ Setujui</button>
                    </form>

                    <form action="{{ route('perizinan.validasi', $izin->id) }}" method="POST" style="margin: 0;">
                      @csrf
                      <input type="hidden" name="validasi" value="ditolak">
                      <button type="submit" class="btn-action btn-danger">✗ Tolak</button>
                    </form>
                  </div>
                @else
                  <span style="color: #9ca3af; font-size: 13px; font-style: italic;">Sudah divalidasi</span>
                @endif
              </td>
              @endcan
            </tr>
          @empty
            <tr>
              @can('validasi izin')
                <td colspan="8" class="empty">
                  Tidak ada data perizinan.
                </td>
              @else
                <td colspan="7" class="empty">
                  Tidak ada data perizinan.
                </td>
              @endcan
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</x-app-layout>