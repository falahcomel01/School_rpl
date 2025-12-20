<x-app-layout>
    <div class="container-permission">
        <div class="card-permission">
            <div class="card-header">
                Form Edit Permission
            </div>

            <div class="card-body">

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('permissions.update', $permissions->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Info singkat --}}
                    <div class="info-grid">
                        <div>
                            <label>ID</label>
                            <input type="text" value="{{ $permissions->id }}" readonly>
                        </div>
                        <div>
                            <label>Dibuat pada</label>
                            <input type="text" value="{{ optional($permissions->created_at)->format('d M Y H:i') }}" readonly>
                        </div>
                    </div>

                    {{-- Nama Permission --}}
                    <div class="form-group">
                        <label for="name">Nama Permission</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $permissions->name) }}"
                            placeholder="contoh: create-user"
                            required
                        >
                        @error('name')
                            <p class="text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="tombol-aksi">
                        <a href="{{ route('permissions.index') }}" class="btn-batal">Batal</a>
                        <button type="submit" class="btn-simpan">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==== STYLE CSS ==== --}}
    <style>
        body {
            background: linear-gradient(to bottom right, #fafafa, #f0f0f0);
            font-family: "Poppins", sans-serif;
        }

        .judul-halaman {
            font-size: 26px;
            font-weight: 700;
            color: #c62828;
            margin-bottom: 20px;
        }

        .container-permission {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 80vh;
            padding: 50px 20px;
        }

        .card-permission {
            background: #fff;
            width: 600px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            animation: fadeIn 0.6s ease;
            border: 1px solid #e0e0e0;
        }

        .card-header {
            background-color: #c62828;
            color: white;
            font-size: 18px;
            font-weight: 600;
            padding: 15px 25px;
            border-bottom: 3px solid #b71c1c;
            letter-spacing: 0.3px;
        }

        .card-body {
            padding: 35px 40px;
        }

        .alert-success {
            background: #e8f5e9;
            border: 1px solid #81c784;
            color: #2e7d32;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #ffebee;
            border: 1px solid #e57373;
            color: #c62828;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 25px;
        }

        .info-grid label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 6px;
        }

        .info-grid input[readonly] {
            background: #f3f3f3;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 9px 14px;
            width: 100%;
            color: #555;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #c62828;
            box-shadow: 0 0 5px rgba(198, 40, 40, 0.3);
            outline: none;
        }

        .tombol-aksi {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
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
            background-color: #c62828;
            color: white;
            border: none;
            box-shadow: 0 3px 8px rgba(198, 40, 40, 0.3);
        }

        .btn-simpan:hover {
            background-color: #b71c1c;
            transform: translateY(-1px);
        }

        .text-error {
            color: #c62828;
            font-size: 13px;
            margin-top: 5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>
