<x-app-layout>

  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-md rounded-lg p-6 form-card">

        {{-- ✅ Alert Success --}}
        @if (session('success'))
          <div class="alert-success">
            {{ session('success') }}
          </div>
        @endif

        {{-- ⚠️ Alert Error --}}
        @if ($errors->any())
          <div class="alert-error">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- === FORM EDIT ROLE === --}}
        <form action="{{ route('roles.update', $roles->id) }}" method="POST">
          @csrf
          @method('PUT')

          <!-- Nama Role -->
          <div class="form-group">
            <label for="name">Nama Role</label>
            <input
              type="text"
              name="name"
              id="name"
              value="{{ old('name', $roles->name) }}"
              placeholder="contoh: admin, editor, kasir"
              required>
          </div>

          <!-- Header Permissions -->
          <div class="permissions-header">
            <label>Permissions</label>
            <div class="btn-group">
              <button type="button" id="btn-select-all" class="btn-outline-red">Pilih semua</button>
              <button type="button" id="btn-clear-all" class="btn-outline-gray">Bersihkan</button>
            </div>
          </div>

          <!-- 🔍 Input Pencarian -->
          <div class="search-box mb-2">
            <input
              type="text"
              id="permission-search"
              placeholder="Cari permission..."
              class="search-input">
          </div>

          <!-- Daftar Permissions -->
          <div class="permissions-box" id="permissions-list">
            @forelse ($permissions as $permission)
              <label class="checkbox-item" data-permission="{{ $permission->name }}">
                <input
                  type="checkbox"
                  name="permission[]"
                  value="{{ $permission->name }}"
                  @checked(collect(old('permission', $hasPermissions ?? []))->contains($permission->name))
                >
                <span>{{ $permission->name }}</span>
              </label>
            @empty
              <p class="no-permission">Belum ada permission.</p>
            @endforelse
          </div>

          <!-- Actions -->
          <div class="button-group">
            <a href="{{ route('roles.index') }}" class="btn-back">Batal</a>
            <button type="submit" class="btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- JS Helper --}}
  <script>
    // Pilih semua / bersihkan
    document.getElementById('btn-select-all')?.addEventListener('click', () => {
      document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = true);
    });
    document.getElementById('btn-clear-all')?.addEventListener('click', () => {
      document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = false);
    });

    // 🔍 Fitur Pencarian
    document.getElementById('permission-search')?.addEventListener('input', function () {
      const query = this.value.toLowerCase();
      const items = document.querySelectorAll('.checkbox-item');

      items.forEach(item => {
        const permissionName = item.getAttribute('data-permission').toLowerCase();
        if (permissionName.includes(query)) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });
  </script>

  {{-- === STYLE === --}}
  <style>
    /* === Tampilan Umum === */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f9fafb, #f1f5f9);
      color: #333;
      margin: 0;
      padding: 0;
    }

    .page-title {
      text-align: center;
      color: #dc2626;
      font-weight: 700;
      font-size: 28px;
      margin-top: 30px;
    }

    /* === Card Form === */
    .form-card {
      border: 1px solid #ddd;
      border-radius: 20px;
      background: #ffffff;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
      transition: 0.3s ease;
    }

    .form-card:hover {
      transform: translateY(-3px);
    }

    /* === Alert === */
    .alert-success {
      background: #dcfce7;
      border: 1px solid #86efac;
      color: #166534;
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-weight: 500;
    }

    .alert-error {
      background: #fee2e2;
      border: 1px solid #fca5a5;
      color: #991b1b;
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .alert-error ul {
      margin: 0;
      padding-left: 20px;
    }

    /* === Input === */
    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      font-weight: 600;
      margin-bottom: 6px;
      display: block;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #bbb;
      border-radius: 8px;
      background-color: #f9fafb;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="text"]:focus {
      border-color: #dc2626;
      box-shadow: 0 0 5px rgba(220, 38, 38, 0.3);
      outline: none;
    }

    /* 🔍 SEARCH BOX */
    .search-box {
      margin-bottom: 10px;
    }

    .search-input {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      background: #fff;
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    }

    .search-input:focus {
      border-color: #dc2626;
      outline: none;
      box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* === Permissions === */
    .permissions-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 8px;
    }

    .permissions-box {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      max-height: 250px;
      overflow-y: auto;
      background: #fafafa;
    }

    .checkbox-item {
      display: flex;
      align-items: center;
      gap: 6px;
      background: #f1f5f9;
      padding: 6px 10px;
      border-radius: 6px;
      margin-bottom: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    .checkbox-item:hover {
      background: #fee2e2;
    }

    .no-permission {
      color: #777;
      font-size: 14px;
      text-align: center;
      margin: 10px 0;
    }

    /* === Tombol === */
    .button-group {
      text-align: right;
      margin-top: 25px;
      border-top: 1px solid #eee;
      padding-top: 20px;
    }

    .btn-primary {
      background: #dc2626;
      color: white;
      font-weight: 600;
      border: none;
      padding: 10px 22px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background: #b91c1c;
      transform: scale(1.03);
    }

    .btn-back {
      color: #111;
      background: white;
      border: 1.8px solid #111;
      margin-right: 10px;
      padding: 9px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn-back:hover {
      background: #111;
      color: white;
    }

    /* === Tombol Outline === */
    .btn-group button {
      padding: 5px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-outline-red {
      border: 1.5px solid #dc2626;
      color: #dc2626;
      background: white;
    }

    .btn-outline-red:hover {
      background: #fee2e2;
    }

    .btn-outline-gray {
      border: 1.5px solid #ccc;
      color: #333;
      background: white;
    }

    .btn-outline-gray:hover {
      background: #f3f4f6;
    }
  </style>
</x-app-layout>