<x-app-layout>
  <div class="container">
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="form-card">
      <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Jurusan --}}
        <div class="mb-4">
          <label>Jurusan</label>
          <select name="jurusan_id" class="w-full border p-2 rounded">
            <option value="">wajib diampu</option>
            @foreach ($jurusan as $j)
              <option value="{{ $j->id }}" {{ old('jurusan_id', $mapel->jurusan_id) == $j->id ? 'selected' : '' }}>
                {{ $j->nama_jurusan }}
              </option>
            @endforeach
          </select>
          @error('jurusan_id') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Nama Mapel --}}
        <div class="mb-4">
          <label>Nama Mapel</label>
          <input type="text" name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" class="w-full border p-2 rounded">
          @error('nama_mapel') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <button class="btn-submit">Update</button>
      </form>
    </div>
  </div>

  <style>
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
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

    .form-card label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .btn-submit {
      background-color: #b91c1c;
      color: #fff;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 6px;
      transition: 0.2s;
    }

    .btn-submit:hover {
      background-color: #991b1b;
    }
  </style>
</x-app-layout>
