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
      max-width: 600px;
      margin: auto;
    }

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 20px;
      text-align: center;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px dashed #f3c5c5;
      font-size: 14px;
    }

    .detail-row strong {
      color: #7f1d1d;
    }

    .badge {
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .badge-success {
      background-color: #dcfce7;
      color: #166534;
    }

    .badge-danger {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .btn-back {
      display: inline-block;
      margin-top: 20px;
      background-color: #fee2e2;
      border: 1px solid #fca5a5;
      color: #b91c1c;
      padding: 8px 18px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-back:hover {
      background-color: #fecaca;
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

      <div class="card">
        <h3 class="header-title">Detail Kelulusan</h3>

        @if($kelulusan->is_legacy)
          <div style="background-color: #fef3c7; border: 1px solid #fbbf24; padding: 8px; border-radius: 6px; text-align: center; margin-bottom: 15px; font-size: 13px; color: #92400e;">
            <strong>Data Legacy</strong> - Data siswa lama yang diinput manual
          </div>
        @endif

        <div class="detail-row">
          <strong>Nama Siswa</strong>
          <span>
            @if($kelulusan->is_legacy)
              {{ $kelulusan->nama_siswa_legacy }}
            @else
              {{ $kelulusan->siswa->user->name ?? '-' }}
            @endif
          </span>
        </div>

        <div class="detail-row">
          <strong>Jurusan</strong>
          <span>
            @if($kelulusan->is_legacy)
              {{ $kelulusan->jurusan_legacy }}
            @else
              {{ $kelulusan->siswa->kelas->jurusan->nama_jurusan ?? '-' }}
            @endif
          </span>
        </div>

        <div class="detail-row">
          <strong>Tahun Lulus</strong>
          <span>{{ $kelulusan->tahun_lulus }}</span>
        </div>

        <div class="detail-row">
          <strong>Nilai Akhir</strong>
          <span>{{ $kelulusan->nilai_akhir ?? '-' }}</span>
        </div>

        <div class="detail-row">
          <strong>Status</strong>
          <span>
            <span class="badge {{ $kelulusan->status === 'lulus' ? 'badge-success' : 'badge-danger' }}">
              {{ strtoupper($kelulusan->status) }}
            </span>
          </span>
        </div>

        <div class="detail-row">
          <strong>Aturan Kelulusan</strong>
          <span>
            Tahun {{ $kelulusan->aturanKelulusan->tahun ?? '-' }}
            (≥ {{ $kelulusan->aturanKelulusan->nilai_minimal ?? '-' }})
          </span>
        </div>

        <a href="{{ route('kelulusan.index') }}" class="btn-back">
          ⬅ Kembali
        </a>
      </div>

    </div>
  </div>

</x-app-layout>
