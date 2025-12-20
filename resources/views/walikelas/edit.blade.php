<x-app-layout>

  <div class="edit-container">
    <div class="edit-card">
      <h3 class="edit-title">Form Edit Data Wali Kelas</h3>

      {{-- ✅ Notifikasi sukses --}}
      @if (session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- 📝 Form Edit --}}
      <form action="{{ route('walikelas.update', $walikelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Dropdown Guru --}}
        <div class="form-group">
          <label for="guru_id">Guru <span class="required">*</span></label>
          <select name="guru_id" id="guru_id" class="form-input" required>
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $g)
              <option value="{{ $g->id }}" {{ old('guru_id', $walikelas->guru_id) == $g->id ? 'selected' : '' }}>
                {{ $g->user->name }}
              </option>
            @endforeach
          </select>
          @error('guru_id')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        {{-- Dropdown Kelas --}}
        <div class="form-group">
          <label for="kelas_id">Kelas <span class="required">*</span></label>
          <select name="kelas_id" id="kelas_id" class="form-input" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
              <option value="{{ $k->id }}" {{ old('kelas_id', $walikelas->kelas_id) == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kelas }} - {{ $k->jurusan?->nama_jurusan ?? '-' }}
              </option>
            @endforeach
          </select>
          @error('kelas_id')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        
       

        {{-- Tombol --}}
        <div class="form-footer">
          <a href="{{ route('walikelas.index') }}" class="btn btn-gray">Batal</a>
          <button type="submit" class="btn btn-red">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <style>
    body {
      background-color: #fafafa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .edit-container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 15px;
    }

    .edit-card {
      width: 100%;
      max-width: 650px;
      background: #fff;
      border-radius: 14px;
      padding: 35px 30px;
      border: 1px solid #f3d6d6;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      transition: 0.3s ease;
    }

    .edit-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .edit-title {
      text-align: center;
      color: #b91c1c;
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 25px;
    }

    .alert-success {
      background: #dcfce7;
      border: 1px solid #bbf7d0;
      color: #166534;
      padding: 10px 15px;
      border-radius: 8px;
      font-size: 14px;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      color: #374151;
      font-size: 14px;
      margin-bottom: 6px;
    }

    .required {
      color: #dc2626;
    }

    .form-input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 14px;
      color: #111;
      transition: all 0.2s ease;
      background-color: #fff;
    }

    .form-input:focus {
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.15);
      outline: none;
    }

    .error {
      font-size: 13px;
      color: #dc2626;
      margin-top: 4px;
    }

    .form-footer {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 25px;
    }

    .btn {
      padding: 9px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      font-size: 13px;
      transition: 0.25s ease;
      cursor: pointer;
      border: none;
    }

    .btn-gray {
      background: #d1d5db;
      color: #111827;
    }

    .btn-gray:hover {
      background: #9ca3af;
    }

    .btn-red {
      background: #b91c1c;
      color: white;
    }

    .btn-red:hover {
      background: #7f1d1d;
    }

    @media (max-width: 640px) {
      .edit-card {
        padding: 25px 20px;
      }
    }
  </style>
</x-app-layout>
