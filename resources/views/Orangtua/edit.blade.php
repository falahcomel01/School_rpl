<x-app-layout>

  <div class="container">

    {{-- Judul --}}
    <div class="top-section">
      <h3 class="section-title">Edit Hubungan Orang Tua & Siswa</h3>
      <a href="{{ route('orangtua.index') }}" class="btn btn-danger">
        ← Kembali
      </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('orangtua.update', $orangtua->id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Orang Tua --}}
      <div class="form-group">
        <label>Pilih Orang Tua <span class="required">*</span></label>
        <select name="user_id" required>
          <option value="">-- Pilih Orang Tua --</option>
          @foreach($orangtuaUsers as $ortu)
            <option value="{{ $ortu->id }}"
              {{ old('user_id', $orangtua->user_id) == $ortu->id ? 'selected' : '' }}>
              {{ $ortu->name }} ({{ $ortu->username }})
            </option>
          @endforeach
        </select>
        @error('user_id')
          <small class="text-error">{{ $message }}</small>
        @enderror
      </div>

      {{-- Siswa --}}
      <div class="form-group">
        <label>Pilih Siswa <span class="required">*</span></label>
        <select name="siswa_id" required>
          <option value="">-- Pilih Siswa --</option>
          @foreach($siswas as $siswa)
            <option value="{{ $siswa->id }}"
              {{ old('siswa_id', $orangtua->siswa_id) == $siswa->id ? 'selected' : '' }}>
              {{ $siswa->user->name }} - {{ $siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
            </option>
          @endforeach
        </select>
        @error('siswa_id')
          <small class="text-error">{{ $message }}</small>
        @enderror
      </div>

      {{-- Info --}}
      <div class="info-box">
        <ul>
          <li>1 orang tua hanya bisa terhubung dengan 1 siswa</li>
          <li>1 siswa hanya bisa terhubung dengan 1 orang tua</li>
          <li>Mengubah data akan memutus hubungan sebelumnya</li>
        </ul>
      </div>

      {{-- Tombol --}}
      <div class="button-group">
        <button type="submit" class="btn btn-danger">
          Simpan Perubahan
        </button>
        <a href="{{ route('orangtua.index') }}" class="btn btn-secondary">
          Batal
        </a>
      </div>

    </form>
  </div>

  {{-- CSS --}}
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
      border: 1px solid #f1dada;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .top-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 6px;
      margin: 0;
    }

    /* Form */
    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      font-size: 14px;
    }

    select {
      width: 100%;
      padding: 8px 10px;
      border-radius: 6px;
      border: 1px solid #f3c5c5;
      font-size: 14px;
    }

    .required {
      color: #dc2626;
    }

    .text-error {
      color: #dc2626;
      font-size: 12px;
    }

    /* Info */
    .info-box {
      background-color: #fef2f2;
      border-left: 4px solid #b91c1c;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 22px;
      font-size: 14px;
      color: #7f1d1d;
    }

    .info-box ul {
      padding-left: 18px;
      margin: 0;
    }

    /* Button */
    .btn {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-danger {
      background-color: #b91c1c;
      color: #fff;
    }

    .btn-danger:hover {
      background-color: #991b1b;
    }

    .btn-secondary {
      background-color: #6b7280;
      color: #fff;
    }

    .btn-secondary:hover {
      background-color: #4b5563;
    }

    .button-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
  </style>

</x-app-layout>
