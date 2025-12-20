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
      transition: 0.3s ease;
    }
    label {
      font-weight: 500;
      color: #374151;
      font-size: 14px;
    }
    input, select {
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      padding: 7px 10px;
      width: 100%;
      font-size: 14px;
      margin-top: 4px;
    }
    input:focus, select:focus {
      outline: none;
      border-color: #b91c1c;
      box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.2);
    }
    .btn {
      font-size: 14px;
      padding: 7px 12px;
      border-radius: 6px;
      font-weight: 600;
      transition: 0.2s;
    }
    .btn:hover { opacity: 0.9; transform: translateY(-1px); }
    .btn-back { background: #f3f4f6; color: #333; }
    .btn-save { background: #b91c1c; color: white; }
    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <h3 class="text-lg font-bold text-red-700 border-b-2 border-red-600 pb-2 mb-4">
          Tambah Data Guru
        </h3>

        @if (session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('guru.store') }}" method="POST">
          @csrf

          {{-- Nama --}}
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
          </div>

          {{-- Username (NIP / kode guru) --}}
          <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
          </div>

          {{-- Password --}}
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" required>
          </div>

          {{-- Jenis Kelamin --}}
          <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>

          {{-- Mata Pelajaran --}}
          <div class="mb-3">
            <label>Mata Pelajaran</label>
            <select name="mapel_id">
              <option value="">-- Pilih Mata Pelajaran --</option>
              @foreach ($mapels as $m)
                <option value="{{ $m->id }}" {{ old('mapel_id') == $m->id ? 'selected' : '' }}>
                  {{ $m->nama_mapel }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Tombol --}}
          <div class="flex justify-end gap-2 mt-4">
            <a href="{{ route('guru.index') }}" class="btn btn-back">Kembali</a>
            <button type="submit" class="btn btn-save">Simpan</button>
          </div>

        </form>
      </div>
    </div>
  </div>

</x-app-layout>
