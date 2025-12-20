<x-app-layout>
    <div class="container">
        <div class="card">
            <form action="{{ route('walikelas.store') }}" method="POST">
                @csrf

                {{-- Dropdown Guru --}}
                <div class="form-group">
                    <label for="guru_id">Guru <span class="required">*</span></label>
                    <select name="guru_id" id="guru_id" class="form-control" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dropdown Kelas --}}
                <div class="form-group">
                    <label for="kelas_id">Kelas <span class="required">*</span></label>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} - {{ $k->jurusan?->nama_jurusan ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Tombol --}}
                <div class="form-footer">
                    <a href="{{ route('walikelas.index') }}" class="btn btn-gray">Batal</a>
                    <button type="submit" class="btn btn-red">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Font dan background dasar */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
        }

        /* Container utama */
        .container {
            display: flex;
            justify-content: center;
            padding: 40px 15px;
        }

        /* Card form */
        .card {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 12px;
            padding: 30px 25px;
            border: 1px solid #f1dada;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Grup form */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 15px;
            color: #444;
            margin-bottom: 6px;
        }

        .required {
            color: #dc2626;
        }

        /* Input & Select */
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            color: #111;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #b91c1c;
            box-shadow: 0 0 0 2px rgba(185, 28, 28, 0.15);
            outline: none;
        }

        /* Pesan error */
        .error {
            font-size: 13px;
            color: #dc2626;
            margin-top: 4px;
        }

        /* Footer tombol */
        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 12.5px;
            transition: 0.25s ease;
            cursor: pointer;
            border: none;
        }

        .btn-gray {
            background: #d1d5db;
            color: #111827;
        }

        .btn-gray:hover {
            background: #9ca3af;
        }

        .btn-red {
            background: #b91c1c;
            color: white;
        }

        .btn-red:hover {
            background: #7f1d1d;
        }

        /* Responsif */
        @media (max-width: 640px) {
            .card {
                padding: 20px;
            }
        }
    </style>
</x-app-layout>
