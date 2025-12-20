<x-app-layout>
  <style>
    /* Gaya mirip file lama */
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

    .header-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #b91c1c;
      border-bottom: 3px solid #b91c1c;
      padding-bottom: 8px;
      margin-bottom: 20px;
    }

    .btn-add {
      background-color: #dc2626;
      color: #fff;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: 0.2s;
    }

    .btn-add:hover {
      background-color: #b91c1c;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    thead {
      background-color: #b91c1c;
      color: white;
    }

    th,
    td {
      border: 1px solid #f3c5c5;
      padding: 10px 12px;
      text-align: center;
    }

    th {
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.5px;
    }

    tbody tr:hover {
      background-color: #fde8e8;
      transition: 0.2s;
    }

    .role-badge {
      background-color: #ffffff;
      color: #333;
      border: 1px solid #ddd;
      font-size: 12px;
      border-radius: 8px;
      padding: 3px 8px;
      display: inline-block;
    }

    .btn {
      display: inline-block;
      font-size: 13px;
      padding: 6px 10px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.2s;
      font-weight: 600;
    }

    .btn-edit {
      background-color: #fee2e2;
      border: 1px solid #fca5a5;
      color: #b91c1c;
    }

    .btn-edit:hover {
      background-color: #fecaca;
    }

    .btn-delete {
      background-color: #dc2626;
      color: white;
      border: none;
    }

    .btn-delete:hover {
      background-color: #b91c1c;
    }

    .alert-success {
      background-color: #d1fae5;
      border-left: 4px solid #10b981;
      color: #065f46;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .alert-error {
      background-color: #fee2e2;
      border-left: 4px solid #dc2626;
      color: #7f1d1d;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .empty {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
      padding: 15px 0;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 6px;
    }
  </style>

  <div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <h3 class="header-title">Daftar Pengguna</h3>
          @can('create users')
            <a href="{{ route('users.create') }}" class="btn-add">+ Tambah User</a>
          @endcan
        </div>

        {{-- Alert sukses --}}
        @if(session('berhasil'))
          <div class="alert-success">{{ session('berhasil') }}</div>
        @endif

        {{-- Alert error --}}
        @if(session('error'))
          <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($users as $index => $user)
                <tr>
                  <td>{{ $users->firstItem() + $index }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @forelse ($user->roles as $role)
                      <span class="role-badge">{{ $role->name }}</span>
                    @empty
                      <span class="text-gray-400 text-xs italic">Tidak ada role</span>
                    @endforelse
                  </td>
                  <td>
                    <div class="action-buttons">
                      @can('edit users')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">Edit</a>
                      @endcan
                      @can('delete users')
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus user ini?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                      @endcan
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="empty">Belum ada data user.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div style="margin-top: 20px;">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
