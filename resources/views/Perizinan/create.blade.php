<x-app-layout>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9fafb;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
      transition: 0.3s ease;
    }

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      font-size: 14px;
      color: #374151;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    select,
    textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #f3c5c5;
      border-radius: 8px;
      font-size: 14px;
      color: #111;
      background-color: #fff;
      transition: 0.25s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.15);
      outline: none;
    }

    .btn-submit {
      background-color: #dc2626;
      color: #fff;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .btn-submit:hover {
      background-color: #b91c1c;
    }

    .btn-cancel {
      background-color: #e5e7eb;
      color: #111827;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .btn-cancel:hover {
      background-color: #d1d5db;
    }

    .form-footer {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }

    .error-message {
      color: #dc2626;
      font-size: 13px;
      margin-top: 4px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="header-title">Formulir Pengajuan izin</h3>

        {{-- ✅ Pesan sukses --}}
        @if (session('success'))
          <div class="bg-green-100 text-green-700 border border-green-400 rounded p-2 mb-4">
            {{ session('success') }}
          </div>
        @endif

        {{-- ✅ Pesan error validasi --}}
        @if ($errors->any())
          <div class="bg-red-100 text-red-700 border border-red-400 rounded p-2 mb-4">
            <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('perizinan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai <span class="text-red-600">*</span></label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
            @error('tanggal_mulai')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai <span class="text-red-600">*</span></label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
            @error('tanggal_selesai')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>

          {{-- 🔁 Ganti dari "Alasan" jadi "Status Izin" --}}
          <div class="form-group">
            <label for="status">Status Izin <span class="text-red-600">*</span></label>
            <select id="status" name="status" required>
              <option value="">-- Pilih Status --</option>
              <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
              <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
            </select>
            @error('status')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>

       

          <div class="form-group">
            <label for="file_surat">Bukti</label>
            <input type="file" id="file_surat" name="file_surat" accept=".pdf,.jpg,.jpeg,.png">
            @error('file_surat')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-footer">
            <a href="{{ route('perizinan.index') }}" class="btn-cancel text-center">Batal</a>
            <button type="submit" class="btn-submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
