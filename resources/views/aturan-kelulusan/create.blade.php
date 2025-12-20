<x-app-layout>
  <div class="container">
    <div class="top-section">
      <h3 class="section-title">Tambah Aturan Kelulusan</h3>
    </div>

    {{-- Alert Error --}}
    @if ($errors->any())
      <div class="alert-error">
        <ul style="margin-left: 16px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('aturan-kelulusan.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label>Tahun</label>
        <input type="number" name="tahun"
               value="{{ old('tahun') }}"
               placeholder="Contoh: 2025"
               required>
      </div>

      <div class="form-group">
        <label>Nilai Minimal</label>
        <input type="number" name="nilai_minimal"
               value="{{ old('nilai_minimal') }}"
               placeholder="Contoh: 75"
               required>
      </div>

      <div class="form-actions">
        <a href="{{ route('aturan-kelulusan.index') }}" class="btn btn-cancel">
          Batal
        </a>
        <button type="submit" class="btn btn-save">
          Simpan
        </button>
      </div>
    </form>
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

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #991b1b;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #374151;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #f3c5c5;
      font-size: 14px;
    }

    .form-group input:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 1px #b91c1c33;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }

    .btn {
      padding: 8px 16px;
      font-size: 13px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-save {
      background-color: #b91c1c;
      color: white;
    }
    .btn-save:hover {
      background-color: #991b1b;
    }

    .btn-cancel {
      background-color: #e5e7eb;
      color: #374151;
    }
    .btn-cancel:hover {
      background-color: #d1d5db;
    }
  </style>
</x-app-layout>
