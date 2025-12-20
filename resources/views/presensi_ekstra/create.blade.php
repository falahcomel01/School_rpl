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

    .info-box {
      background-color: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 8px;
      padding: 15px 20px;
      margin-bottom: 25px;
    }

    .info-box h4 {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      margin: 0 0 5px 0;
    }

    .info-box p {
      font-size: 0.9rem;
      color: #7f1d1d;
      margin: 0;
    }

    .table-container {
      overflow-x: auto;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #b91c1c;
      color: white;
    }

    th,
    td {
      border: 1px solid #f3c5c5;
      padding: 10px 12px;
      text-align: left;
    }

    th {
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.5px;
      font-weight: 600;
    }

    tbody tr:nth-child(even) {
      background-color: #fef2f2;
    }

    tbody tr:hover {
      background-color: #fde8e8;
    }

    .text-center {
      text-align: center;
    }

    .form-select {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 6px 10px;
      font-size: 14px;
      background-color: white;
    }

    .form-select:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.1);
    }

    .text-muted {
      color: #6b7280;
      font-size: 12px;
      display: block;
      margin-top: 4px;
    }

    .btn-group {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }

    .btn {
      display: inline-block;
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
      cursor: pointer;
      border: none;
    }

    .btn-primary {
      background-color: #dc2626;
      color: white;
    }

    .btn-primary:hover {
      background-color: #b91c1c;
    }

    .btn-secondary {
      background-color: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
      background-color: #e5e7eb;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    .alert-error ul {
      margin: 5px 0 0 20px;
      padding: 0;
    }

    .alert-error li {
      margin-bottom: 5px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">
          <i class="fas fa-user-check me-2"></i>Input Presensi Ekstrakurikuler
        </h3>

        <!-- Informasi Ekstrakurikuler -->
        <div class="info-box">
          <h4>{{ $ekstra->nama_extra }}</h4>
          <p>Pembina: {{ $ekstra->pembina->user->name ?? '-' }}</p>
          <p>Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
        </div>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
          <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (session('error'))
          <div class="alert-error">{{ session('error') }}</div>
        @endif

        <!-- Form Presensi -->
        <form action="{{ route('presensi_ekstra.store') }}" method="POST">
          @csrf
          <!-- Hidden fields untuk identifikasi -->
          <input type="hidden" name="ekstrakurikuler_id" value="{{ $ekstra->id }}">
          <input type="hidden" name="tanggal" value="{{ $tanggal }}">

          <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="35%">Nama Siswa</th>
                  <th width="20%">Kelas</th>
                  <th width="40%">Status Kehadiran</th>
                </tr>
              </thead>
              <tbody>
                @forelse($pesertas as $index => $peserta)
                  <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                      <strong>{{ $peserta->siswa->user->name }}</strong>
                    </td>
                    <td>{{ $peserta->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>
                      <select name="status[{{ $peserta->id }}]" class="form-select">
                        <option value="hadir" {{ $peserta->status_default == 'hadir' ? 'selected' : '' }}>✅ Hadir</option>
                        <option value="izin" {{ $peserta->status_default == 'izin' ? 'selected' : '' }}>📄 Izin</option>
                        <option value="sakit" {{ $peserta->status_default == 'sakit' ? 'selected' : '' }}>🤒 Sakit</option>
                        <option value="alpa" {{ $peserta->status_default == 'alpa' ? 'selected' : '' }}>❌ Alpa</option>
                      </select>
                      @if($peserta->izin_info)
                        <small class="text-muted">
                          <i class="fas fa-info-circle me-1"></i>
                          Catatan Izin: {{ $peserta->izin_info->keterangan }}
                        </small>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center">
                      <i class="fas fa-user-slash me-2"></i>Belum ada peserta terdaftar di ekstrakurikuler ini.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="btn-group">
            <a href="{{ route('presensi_ekstra.index') }}" class="btn btn-secondary">
              <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-1"></i>Simpan Presensi
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>