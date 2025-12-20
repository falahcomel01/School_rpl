<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between header-bar">
      <h2 class="font-semibold text-xl text-white leading-tight">Edit User</h2>
      <a href="{{ route('users.index') }}" class="btn-back">Kembali</a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-md rounded-lg p-6 form-card">
        
        <h3 class="form-title">Edit User</h3>

        {{-- ✅ Alert sukses --}}
        @if(session('berhasil'))
          <div class="mb-4 bg-green-50 border border-green-200 text-green-800 p-3 rounded">
            {{ session('berhasil') }}
          </div>
        @endif

        {{-- ⚠️ Alert error --}}
        @if ($errors->any())
          <div class="mb-4 bg-red-50 border border-red-200 text-red-800 p-3 rounded">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- ✏️ Form Edit --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
          @csrf
          @method('PUT')

          {{-- Nama --}}
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $user->name) }}"
                   required>
            @error('name') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          {{-- Username --}}
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"
                   value="{{ old('username', $user->username) }}"
                   required>
            @error('username') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          {{-- Email --}}
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   required>
            @error('email') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          {{-- Role --}}
          <div class="form-group">
            <label>Role</label>
            <div class="checkbox-group">
              @foreach ($roles as $role)
                <label class="checkbox-item">
                  <input type="checkbox" name="role[]" value="{{ $role->name }}"
                    {{ in_array($role->id, $hasRole) ? 'checked' : '' }}>
                  <span>{{ $role->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          {{-- Tombol --}}
          <div class="text-end mt-6 border-t pt-4">
            <a href="{{ route('users.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <style>
    /* === Header Bar === */
    .header-bar {
      background-color: #dc2626;
      padding: 14px 20px;
      border-radius: 10px;
      color: white;
      margin-top: 15px;
    }

    .btn-back {
      background: white;
      color: #dc2626;
      border: 1.5px solid white;
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
    }

    .btn-back:hover {
      background: #b91c1c;
      color: white;
      border-color: #b91c1c;
    }

    /* === Form Card === */
    .form-card {
      border: 1px solid #eee;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      background-color: #fafafa;
    }

    .form-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    /* === Judul Form === */
    .form-title {
      text-align: center;
      font-size: 22px;
      font-weight: 700;
      color: #dc2626;
      margin-bottom: 25px;
      letter-spacing: 0.5px;
    }

    /* === Input Group === */
    .form-group label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 6px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      background-color: #f9fafb;
      transition: 0.3s;
    }

    .form-group input:focus {
      border-color: #dc2626;
      box-shadow: 0 0 5px rgba(220, 38, 38, 0.3);
      outline: none;
    }

    /* === Checkbox === */
    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .checkbox-item {
      background: #f3f4f6;
      padding: 6px 10px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    .checkbox-item:hover {
      background: #fee2e2;
    }

    /* === Buttons === */
    .btn-save {
      background: #dc2626;
      color: white;
      font-weight: 600;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-save:hover {
      background: #b91c1c;
      transform: scale(1.03);
    }

    .btn-cancel {
      background: white;
      color: #111;
      border: 1.5px solid #111;
      padding: 9px 20px;
      border-radius: 8px;
      font-weight: 600;
      margin-right: 8px;
      transition: all 0.3s;
    }

    .btn-cancel:hover {
      background: #111;
      color: white;
    }

    /* === Error Text === */
    .error-text {
      color: #dc2626;
      font-size: 14px;
      margin-top: 4px;
    }
  </style>
</x-app-layout>
