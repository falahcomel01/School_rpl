<x-app-layout>
    <div class="container">
        <div class="card">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            {{-- Header dengan Judul & Tombol --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 class="header-title" style="border: none; margin-bottom: 0;">Daftar Permission</h3>
                <a href="{{ route('permissions.create') }}" class="btn-add">+ Tambah Permission</a>
            </div>

            {{-- 🔍 Input Pencarian --}}
            <div class="search-box">
                <input
                    type="text"
                    id="permission-search"
                    placeholder="Cari permission..."
                    class="search-input">
            </div>

            {{-- Table --}}
            @if($permissions->count())
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Permission</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="permission-table-body">
                        @foreach($permissions as $permission)
                            <tr data-name="{{ $permission->name }}">
                                <td>{{ $permissions->firstItem() + $loop->index }}</td>
                                <td style="font-weight:600;">{{ $permission->name }}</td>
                                <td>{{ optional($permission->created_at)->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-edit">Edit</a>
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus permission ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="pagination-info">
                    <span>Menampilkan {{ $permissions->firstItem() }} - {{ $permissions->lastItem() }} dari total {{ $permissions->total() }} permission.</span>
                    <div style="float: right;">
                        {{ $permissions->links() }}
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <p>Belum ada data permission.</p>
                    <a href="{{ route('permissions.create') }}" class="btn-add">+ Tambah Permission</a>
                </div>
            @endif
        </div>
    </div>

    {{-- ✨ JavaScript untuk Pencarian --}}
    <script>
        document.getElementById('permission-search')?.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#permission-table-body tr');

            let visibleCount = 0;
            rows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                if (name.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Opsional: tampilkan pesan jika tidak ada hasil
            // (kamu bisa tambahkan ini jika mau)
        });
    </script>

    <style>
        /* Struktur Umum */
        .container {
            padding: 40px;
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

        /* 🔍 Search Box */
        .search-box {
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #b91c1c;
            box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.15);
        }

        /* Tombol Tambah */
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

        /* Flash Message */
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

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            background-color: #b91c1c;
            color: white;
        }

        th, td {
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

        /* Tombol Aksi */
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

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        /* Pagination */
        .pagination-info {
            margin-top: 15px;
            font-size: 13px;
            color: #6b7280;
        }

        /* Empty State */
        .empty-state {
            border: 2px dashed #f3c5c5;
            border-radius: 12px;
            text-align: center;
            padding: 40px 0;
            color: #9ca3af;
            margin-top: 20px;
        }

        .empty-state p {
            margin-bottom: 15px;
        }
    </style>
</x-app-layout>