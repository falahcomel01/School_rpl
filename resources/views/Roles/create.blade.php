<x-app-layout>

    <div class="container-form">
        <div class="card-form">
            <div class="card-header">
                Form Tambah Role
            </div>

            <div class="card-body">

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert success">{{ session('success') }}</div>
                @endif

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="alert error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    {{-- Nama Role --}}
                    <div class="form-group">
                        <label for="name">Nama Role</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name') }}"
                               placeholder="Contoh: admin, editor, kasir"
                               required>
                    </div>

                    {{-- Permission Picker --}}
                    <div class="form-group">
                        <div class="label-flex">
                            <label>Permissions</label>
                            <div class="check-all">
                                <input id="selectAll" type="checkbox">
                                <label for="selectAll">Pilih Semua</label>
                            </div>
                        </div>

                        <div class="grid-permissions">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="perm-item">
                                        <input type="checkbox"
                                               id="permission-{{ $permission->id }}"
                                               class="permItem"
                                               name="permission[]"
                                               value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="tombol-aksi">
                        <a href="{{ route('roles.index') }}" class="btn-batal">Batal</a>
                        <button type="submit" class="btn-simpan">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Pilih semua permission
        document.getElementById('selectAll')?.addEventListener('change', (e) => {
            document.querySelectorAll('.permItem').forEach(i => {
                i.checked = e.target.checked;
            });
        });
    </script>

    {{-- ==== CSS ====/ --}}
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fb, #eef1f5);
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        .judul-halaman {
            font-size: 26px;
            font-weight: 700;
            color: #b71c1c;
            text-align: center;
            margin-top: 35px;
            margin-bottom: 15px;
        }

        .container-form {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 85vh;
            padding: 40px 20px;
        }

        .card-form {
            background: #fff;
            width: 820px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        .card-header {
            background-color: #b71c1c;
            color: white;
            font-size: 18px;
            font-weight: 600;
            padding: 15px 25px;
            border-bottom: 3px solid #a31616;
            text-align: center;
        }

        .card-body {
            padding: 40px 50px;
        }

        .alert {
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert.success {
            background-color: #e6f9ee;
            color: #1e8449;
            border: 1px solid #a6e3b8;
        }

        .alert.error {
            background-color: #fdecea;
            color: #b71c1c;
            border: 1px solid #f5b7b1;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #b71c1c;
            box-shadow: 0 0 5px rgba(183, 28, 28, 0.3);
            outline: none;
        }

        .label-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .check-all {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: #555;
        }

        .grid-permissions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 8px 15px;
            margin-top: 10px;
        }

        .perm-item {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #fafafa;
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .perm-item:hover {
            background: #f0f0f0;
        }

        .perm-item input {
            accent-color: #b71c1c;
            transform: scale(1.1);
        }

        .tombol-aksi {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 35px;
        }

        .btn-batal,
        .btn-simpan {
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-batal {
            background: #f3f3f3;
            color: #555;
            border: 1px solid #ccc;
        }

        .btn-batal:hover {
            background: #e0e0e0;
        }

        .btn-simpan {
            background-color: #b71c1c;
            color: white;
            border: none;
        }

        .btn-simpan:hover {
            background-color: #a31616;
            transform: translateY(-1px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>
