<x-app-layout>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #f1dada;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease;
            max-width: 650px;
            margin: auto;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            width: 100%;
            border: 1px solid #d2d2d2;
            border-radius: 8px;
            padding: 10px;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #b91c1c;
            box-shadow: 0 0 4px rgba(185, 28, 28, 0.3);
        }

        .btn-red {
            background-color: #dc2626;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-red:hover {
            background-color: #b91c1c;
        }

        .btn-gray {
            background-color: #6b7280;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-gray:hover {
            background-color: #4b5563;
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
    </style>

    <div class="py-8">
        <div class="card">

            {{-- Alert error --}}
            @if ($errors->any())
                <div class="alert-error">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Alert sukses --}}
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h3 class="header-title" style="
                font-size: 1.5rem; 
                font-weight: 700;
                color: #b91c1c;
                border-bottom: 3px solid #b91c1c;
                padding-bottom: 8px;
                margin-bottom: 20px;
            ">
                Form Tambah Tugas
            </h3>

            <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- MAPEL --}}
                <div class="mb-3">
                    <label class="form-label">Mapel <span class="text-red-500">*</span></label>
                    <select name="mapel_id" class="form-control @error('mapel_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapels as $m)
                            <option value="{{ $m->id }}" {{ old('mapel_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                    @error('mapel_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- KELAS --}}
                <div class="mb-3">
                    <label class="form-label">Kelas <span class="text-red-500">*</span></label>
                    <select name="kelas_id" class="form-control @error('kelas_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} - {{ $k->jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label class="form-label">Judul Tugas <span class="text-red-500">*</span></label>
                    <input type="text" name="judul_tugas" value="{{ old('judul_tugas') }}"
                           class="form-control @error('judul_tugas') border-red-500 @enderror"
                           placeholder="Masukkan judul tugas" required>
                    @error('judul_tugas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4"
                              class="form-control @error('deskripsi') border-red-500 @enderror"
                              placeholder="Masukkan deskripsi tugas" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- FILE --}}
                <div class="mb-3">
                    <label class="form-label">File (opsional)</label>
                    <input type="file" name="file_tugas"
                           class="form-control @error('file_tugas') border-red-500 @enderror"
                           accept=".pdf,.doc,.docx,.ppt,.pptx,.zip">
                    <p class="text-xs text-gray-500 mt-1">
                        Format: PDF, DOC, DOCX, PPT, PPTX, ZIP (Max: 10MB)
                    </p>
                    @error('file_tugas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- DEADLINE --}}
                <div class="mb-3">
                    <label class="form-label">Deadline <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="deadline" value="{{ old('deadline') }}"
                           class="form-control @error('deadline') border-red-500 @enderror"
                           required>
                    @error('deadline')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="flex gap-2 mt-4">
                    <button type="submit" class="btn-red">Simpan</button>
                    <a href="{{ route('tugas.index') }}" class="btn-gray">Batal</a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
