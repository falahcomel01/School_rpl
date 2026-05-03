<x-app-layout>
  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-md rounded-lg p-6 form-card">
        <h3 class="form-title">Form Tambah Data User</h3>

        <form action="{{ route('users.store') }}" method="POST">
          @csrf
          
          <!-- Nama -->
          <div class="mb-4 form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
              <p class="text-red-500">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email -->
          <div class="mb-4 form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
              <p class="text-red-500">{{ $message }}</p>
            @enderror
          </div>

          <!-- Username -->
          <div class="mb-4 form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}">
            @error('username')
              <p class="text-red-500">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-4 form-group">
            <label>Password</label>
            <input type="password" name="password">
            @error('password')
              <p class="text-red-500">{{ $message }}</p>
            @enderror
          </div>

          <!-- Role -->
          <div class="mb-4 form-group">
            <label>Role</label>
            <div class="checkbox-group">
              @foreach ($roles as $role)
                <label class="checkbox-item">
                  <input type="checkbox" name="roles[]" value="{{ $role->name }}">
                  <span>{{ $role->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- Tombol -->
          <div class="button-group">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('users.index') }}" class="btn-back">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <style>
    /* 🌈 Background & Font */
    body {
      background: linear-gradient(135deg, #f8fafc, #e2e8f0);
      font-family: 'Poppins', sans-serif;
      color: #333;
      margin: 0;
      padding: 0;
    }

    /* Judul Halaman */
    .page-title {
      text-align: center;
      color: #dc2626;
      font-weight: 700;
      font-size: 28px;
      margin-top: 30px;
      letter-spacing: 0.5px;
    }

    /* Kartu Form */
    .form-card {
      border: 1px solid #ddd;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      background-color: #fafafa;
    }

    .form-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Judul Form */
    .form-title {
      text-align: center;
      font-size: 20px;
      font-weight: 600;
      color: #dc2626;
      margin-bottom: 25px;
    }

    /* Input & Label */
    .form-group label {
      font-weight: 600;
      color: #333;
      display: block;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #bbb;
      border-radius: 8px;
      font-size: 15px;
      background-color: #f9fafb;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus {
      border-color: #dc2626;
      outline: none;
      box-shadow: 0 0 6px rgba(220, 38, 38, 0.3);
    }

    /* Checkbox */
    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .checkbox-item {
      display: flex;
      align-items: center;
      gap: 6px;
      background: #f1f5f9;
      padding: 6px 10px;
      border-radius: 6px;
      transition: 0.3s;
      cursor: pointer;
    }

    .checkbox-item:hover {
      background: #fee2e2;
    }

    /* Tombol */
    .button-group {
      text-align: right;
      margin-top: 25px;
    }

    .btn-primary {
      background: #dc2626;
      color: white;
      font-weight: 600;
      border: none;
      padding: 10px 22px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #b91c1c;
      transform: scale(1.03);
    }

    .btn-back {
      display: inline-block;
      color: #111;
      background: white;
      border: 1.8px solid #111;
      margin-left: 10px;
      padding: 9px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
    }

    .btn-back:hover {
      background: #111;
      color: white;
    }

    /* Error Text */
    .text-red-500 {
      color: #dc2626 !important;
      font-size: 13px;
      margin-top: 4px;
    }
  </style>
</x-app-layout>
