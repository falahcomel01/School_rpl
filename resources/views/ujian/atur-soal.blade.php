<x-app-layout>

  <div class="elite-container">

    @if (session('success'))
      <div class="elite-alert elite-alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="elite-card">
      <div class="elite-card-header">
        Pilih Jenis Ujian — Soal Akan Dipilih Otomatis
      </div>

      <form action="{{ route('ujian.store-soal', $ujian->id) }}" method="POST">
        @csrf

        <div class="elite-card-body">
          @foreach ($jenisUjians as $jenisUjian)
            <div class="elite-bab-item">
              <label class="elite-checkbox-label">
                <input
                  type="checkbox"
                  name="jenis_ujian[]"
                  value="{{ $jenisUjian->id }}"
                  {{ in_array($jenisUjian->id, $jenisUjianDipilih ?? []) ? 'checked' : '' }}
                  class="elite-checkbox"
                >
                <span class="elite-bab-title">
                  📝 Jenis Ujian: {{ $jenisUjian->nama_jenis_ujian }}
                </span>
              </label>
              <p class="elite-bab-desc">
                {{ $jenisUjian->soals->count() }} soal tersedia
              </p>
            </div>
          @endforeach
        </div>

        <div class="elite-card-footer">
          <button type="submit" class="elite-btn elite-btn-primary">
            💾 Simpan (Soal Otomatis)
          </button>
        </div>
      </form>
    </div>

  </div>

  <style>
    body {
      font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #2d3748;
    }

    .elite-container {
      max-width: 800px;
      margin: 48px auto;
      padding: 0 20px;
    }

    /* Alert */
    .elite-alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 24px;
      font-size: 14px;
    }
    .elite-alert-success {
      background-color: #e6f4ea;
      border-left: 4px solid #1e8e3e;
      color: #137333;
    }

    /* Card */
    .elite-card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
      border: 1px solid #eee;
      overflow: hidden;
    }

    .elite-card-header {
      background-color: #b91c1c;
      color: white;
      padding: 18px 24px;
      font-weight: 700;
      font-size: 1.1rem;
      letter-spacing: 0.5px;
    }

    .elite-card-body {
      padding: 24px;
    }

    .elite-card-footer {
      padding: 20px 24px;
      background-color: #f9fafb;
      border-top: 1px solid #eee;
      text-align: right;
    }

    /* BAB Item */
    .elite-bab-item {
      background-color: #fdf7f7;
      border: 1px solid #f8d5d5;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 16px;
      transition: all 0.2s ease;
    }
    .elite-bab-item:hover {
      background-color: #fef0f0;
      border-color: #f1bfbf;
    }

    /* Checkbox Custom */
    .elite-checkbox-label {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      cursor: pointer;
      font-weight: 600;
      color: #b91c1c;
      font-size: 15px;
    }

    .elite-checkbox {
      width: 18px;
      height: 18px;
      margin-top: 2px;
      accent-color: #b91c1c;
      cursor: pointer;
    }

    .elite-bab-desc {
      margin: 6px 0 0 30px;
      color: #64748b;
      font-size: 13px;
      font-style: italic;
    }

    /* Tombol */
    .elite-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 24px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
      white-space: nowrap;
      border: none;
    }
    .elite-btn-primary {
      background-color: #b91c1c;
      color: white;
    }
    .elite-btn-primary:hover {
      background-color: #991b1b;
      transform: translateY(-1px);
      box-shadow: 0 2px 6px rgba(185, 28, 28, 0.2);
    }

    /* Responsif */
    @media (max-width: 600px) {
      .elite-container {
        padding: 0 12px;
        margin: 24px 12px;
      }
      .elite-card-header,
      .elite-card-body,
      .elite-card-footer {
        padding-left: 16px;
        padding-right: 16px;
      }
      .elite-btn {
        width: 100%;
        justify-content: center;
      }
      .elite-card-footer {
        text-align: center;
      }
    }
  </style>

</x-app-layout>