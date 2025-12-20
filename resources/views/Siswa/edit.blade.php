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
          Edit Data Siswa
        </h3>

        @if (session('success'))
          <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('siswa.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Nama --}}
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
          </div>

          {{-- NIS --}}
          <div class="mb-3">
            <label>NIS</label>
         <input type="number"
       name="username"
       min="1"
       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-600 focus:ring-red-600"
       value="{{ old('username', $user->username) }}"
       required>

          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">
          </div>

          {{-- Kelas --}}
          <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas_id" required>
              <option value="">-- Pilih Kelas --</option>
              @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ old('kelas_id', $user->siswa?->kelas_id) == $k->id ? 'selected' : '' }}>
                  {{ $k->nama_kelas }} - {{ $k->jurusan?->nama_jurusan ?? '-' }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Jenis Kelamin --}}
          <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki" {{ old('jenis_kelamin', $user->siswa?->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ old('jenis_kelamin', $user->siswa?->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>

          {{-- Tombol --}}
          <div class="flex justify-end gap-2 mt-4">
            <a href="{{ route('siswa.index') }}" class="btn btn-back">Kembali</a>
            <button type="submit" class="btn btn-save">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
