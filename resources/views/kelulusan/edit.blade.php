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

    label {
      font-weight: 600;
      font-size: 14px;
      color: #7f1d1d;
      margin-bottom: 4px;
      display: block;
    }

    select, input {
      width: 100%;
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      padding: 8px 10px;
      font-size: 14px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .btn-update {
      background-color: #dc2626;
      color: #fff;
      padding: 8px 18px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-update:hover {
      background-color: #b91c1c;
    }

    .btn-back {
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

    .action-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

      <div class="card">
        <h3 class="header-title">Edit Kelulusan</h3>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
          <div class="alert-error">
            <ul class="list-disc pl-4">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('kelulusan.update', $kelulusan->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Aturan Kelulusan</label>
            <select name="aturan_kelulusan_id" required>
              @foreach($aturans as $aturan)
                <option value="{{ $aturan->id }}"
                  {{ $aturan->id == old('aturan_kelulusan_id', $kelulusan->aturan_kelulusan_id) ? 'selected' : '' }}>
                  Tahun {{ $aturan->tahun }} (≥ {{ $aturan->nilai_minimal }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Nilai Akhir</label>
            <input type="number"
                   step="0.01"
                   name="nilai_akhir"
                   value="{{ old('nilai_akhir', $kelulusan->nilai_akhir) }}">
          </div>

          <div class="action-buttons">
            <a href="{{ route('kelulusan.index') }}" class="btn-back">
              Batal
            </a>
            <button type="submit" class="btn-update">
              Update
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>

</x-app-layout>
