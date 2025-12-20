<x-app-layout>


    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            border: 1px solid #f1dada;
            padding: 25px;
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
        }

        .btn-add:hover { background-color: #b91c1c; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        thead { background-color: #b91c1c; color: white; }
        th, td { border: 1px solid #f3c5c5; padding: 10px 12px; text-align: center; }
        tbody tr:hover { background-color: #fde8e8; transition: 0.2s; }

        .permission-badge {
            background-color: #ffffff;
            border: 1px solid #ddd;
            font-size: 12px;
            border-radius: 8px;
            padding: 3px 8px;
        }

        .btn {
            display: inline-block;
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-edit { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
        .btn-edit:hover { background-color: #fecaca; }

        .btn-delete { background-color: #dc2626; color: white; border: none; }
        .btn-delete:hover { background-color: #b91c1c; }

        .alert-success {
            background-color: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .empty { text-align: center; color: #9ca3af; font-style: italic; padding: 15px 0; }

        .action-buttons { display: flex; justify-content: center; gap: 6px; }
    </style>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="card">

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 class="header-title">Daftar Roles</h3>

                    @can('create roles')
                        <a href="{{ route('roles.create') }}" class="btn-add">+ Tambah Role</a>
                    @endcan
                </div>

                @if (session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Permissions</th>
                            <th>Dibuat Pada</th>
                            @canany(['edit roles','delete roles'])
                                <th>Aksi</th>
                            @endcanany
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="font-weight:600;">{{ $role->name }}</td>
                                <td>
                                    @if($role->permissions->count())
                                        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:5px;">
                                            @foreach($role->permissions as $perm)
                                                <span class="permission-badge">{{ $perm->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs italic">—</span>
                                    @endif
                                </td>
                                <td>{{ optional($role->created_at)->format('Y-m-d H:i') }}</td>

                                @canany(['edit roles','delete roles'])
                                    <td>
                                        <div class="action-buttons">
                                            @can('edit roles')
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-edit">Edit</a>
                                            @endcan

                                            @can('delete roles')
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin menghapus role ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @endcanany
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">Belum ada data role.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
