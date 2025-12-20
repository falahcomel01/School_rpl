<x-app-layout>

  <div class="container">

    <div class="top-section">
      <h3 class="section-title">Form Edit Jenis Ujian</h3>
    </div>

    <form action="{{ route('jenis-ujian.update', $jenisUjian->id) }}" method="POST" class="form-card">
      @csrf
      @method('PUT')

      {{-- Admin & TU bisa ganti guru --}}
      @if($user->role !== 'guru')
        <div class="form-group">
          <label class="form-label">Pilih Guru</label>
          <select name="guru_id" class="form-input">
            @foreach ($gurus as $guru)
              <option value="{{ $guru->id }}" {{ $jenisUjian->guru_id == $guru->id ? 'selected' : '' }}>
                {{ $guru->user->name }} — {{ $guru->mapel->nama_mapel ?? '-' }}
              </option>
            @endforeach
          </select>

          @error('guru_id')
            <p class="text-error">{{ $message }}</p>
          @enderror
        </div>
      @endif

      <div class="form-group">
        <label class="form-label">Nama Jenis Ujian</label>
        <input type="text" name="nama_jenis_ujian" class="form-input"
               value="{{ old('nama_jenis_ujian', $jenisUjian->nama_jenis_ujian) }}">

        @error('nama_jenis_ujian')
          <p class="text-error">{{ $message }}</p>
        @enderror
      </div>

      <button class="btn-submit">Update</button>
    </form>

  </div>

  {{-- CSS --}}
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fafafa;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1dada;
      padding: 30px;
    }

    .page-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin-bottom: 25px;
    }

    .top-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      display: inline-block;
      padding-bottom: 6px;
      margin: 0;
    }

    /* FORM CARD */
    .form-card {
      background: #fff;
      padding: 25px;
      border: 1px solid #f3c5c5;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
      margin-top: 20px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-label {
      font-weight: 600;
      color: #b91c1c;
      display: block;
      margin-bottom: 6px;
    }

    .form-input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #f3c5c5;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
      transition: 0.2s;
    }

    .form-input:focus {
      border-color: #b91c1c;
      box-shadow: 0 0 5px rgba(185, 28, 28, 0.3);
    }

    .text-error {
      color: #dc2626;
      font-size: 13px;
      margin-top: 4px;
    }

    .btn-submit {
      background-color: #b91c1c;
      color: white;
      padding: 10px 18px;
      font-size: 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.2s;
    }

    .btn-submit:hover {
      background-color: #991b1b;
    }

  </style>

</x-app-layout>