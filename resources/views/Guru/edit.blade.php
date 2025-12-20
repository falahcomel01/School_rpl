<x-app-layout>
    <div class="edit-wrapper">
        <div class="edit-card">
            <h3 class="form-title">Form Edit Data Guru</h3>

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('guru.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="form-group">
                    <label>Nama</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        class="form-control">
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label>NIP</label>
                    <input 
                        type="text" 
                        name="username" 
                        value="{{ old('username', $user->username) }}" 
                        class="form-control">
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        class="form-control">
                </div>

              

                {{-- Jenis Kelamin --}}
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" 
                            {{ old('jenis_kelamin', optional($user->guru)->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" 
                            {{ old('jenis_kelamin', optional($user->guru)->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                {{-- Mata Pelajaran --}}
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <select name="mapel_id" class="form-control">
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}"
                                {{ old('mapel_id', optional($user->guru)->mapel_id) == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="button-group">
                    <a href="{{ route('guru.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
    {{-- CSS yang AMAN (pakai prefix biar gak bentrok Tailwind) --}}
    <style>
        .edit-header {
            font-size: 1.6rem;
            font-weight: 700;
            color: #dc2626;
            margin-bottom: 1rem;
        }

        .edit-wrapper {
            background: #f9fafb;
            min-height: calc(100vh - 120px);
            padding: 2rem 1rem;
            overflow: hidden;
        }

        .edit-card {
            background: #ffffff;
            max-width: 700px;
            margin: 0 auto;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .edit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            border-left: 4px solid #dc2626;
            padding-left: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 0.3rem;
        }

        .form-control {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
            outline: none;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
            margin-top: 1.5rem;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background 0.25s;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
        }

        .btn-save {
            background: #dc2626;
            color: white;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-save:hover {
            background: #b91c1c;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.25);
        }

        @media (max-width: 640px) {
            .edit-card { padding: 1.5rem; }
            .edit-header { font-size: 1.3rem; }
        }
    </style>
</x-app-layout>
