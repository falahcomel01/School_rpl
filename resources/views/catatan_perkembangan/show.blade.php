<x-app-layout>
  <div class="container">
    <h3 class="section-title">Detail Catatan Perkembangan</h3>

    <div class="detail-card">
      <p><strong>Siswa:</strong> {{ $catatan_perkembangan->siswa->user->name }}</p>
      <p><strong>Semester:</strong> {{ ucfirst($catatan_perkembangan->semester) }}</p>
      <p><strong>Tahun Ajaran:</strong> {{ $catatan_perkembangan->tahun_ajaran }}</p>

      <hr>

      <h4>Catatan Akademik</h4>
      <p>{{ $catatan_perkembangan->catatan_akademik }}</p>

      <h4>Catatan Non Akademik</h4>
      <p>{{ $catatan_perkembangan->catatan_non_akademik }}</p>
    </div>

    <a href="{{ route('catatan_perkembangan.index') }}" class="btn btn-back">Kembali</a>
  </div>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 700px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin-bottom: 25px;
    }

    .detail-card {
      background-color: #f9fafb;
      border-radius: 10px;
      padding: 20px;
    }

    .detail-row {
      display: flex;
      padding: 12px 0;
      border-bottom: 1px solid #e5e7eb;
    }

    .detail-row:last-child {
      border-bottom: none;
    }

    .detail-row.catatan-row {
      flex-direction: column;
    }

    .detail-label {
      font-weight: 600;
      color: #6b7280;
      width: 180px;
      flex-shrink: 0;
    }

    .detail-value {
      color: #111827;
    }

    .catatan-content {
      margin-top: 10px;
      background-color: #fff;
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      color: #374151;
      line-height: 1.6;
      white-space: pre-wrap;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      margin-top: 25px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: 0.2s;
      border: none;
    }

    .btn-back {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-back:hover {
      background-color: #991b1b;
    }
  </style>
</x-app-layout>
