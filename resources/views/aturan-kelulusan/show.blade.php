<x-app-layout>
  <div class="container">
    <div class="top-section">
      <h3 class="section-title">Detail Aturan Kelulusan</h3>
    </div>

    <div class="detail-box">
      <div class="detail-item">
        <span class="label">Tahun</span>
        <span class="value">{{ $aturanKelulusan->tahun }}</span>
      </div>

      <div class="detail-item">
        <span class="label">Nilai Minimal</span>
        <span class="value">{{ $aturanKelulusan->nilai_minimal }}</span>
      </div>
    </div>

    <div class="action-area">
      <a href="{{ route('aturan-kelulusan.index') }}" class="btn btn-back">
     Kembali
      </a>
    </div>
  </div>

  {{-- ========================= STYLE ========================= --}}
  <style>
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .top-section {
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 6px;
    }

    .detail-box {
      margin-top: 20px;
    }

    .detail-item {
      display: flex;
      justify-content: space-between;
      padding: 12px 15px;
      border: 1px solid #f3c5c5;
      border-radius: 8px;
      margin-bottom: 12px;
      background-color: #fff7f7;
    }

    .label {
      font-weight: 600;
      color: #374151;
    }

    .value {
      font-weight: 600;
      color: #b91c1c;
    }

    .action-area {
      margin-top: 25px;
      text-align: right;
    }

    .btn {
      padding: 8px 16px;
      font-size: 13px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-back {
      background-color: #2563eb;
      color: white;
    }

    .btn-back:hover {
      background-color: #1d4ed8;
    }
  </style>
</x-app-layout>
