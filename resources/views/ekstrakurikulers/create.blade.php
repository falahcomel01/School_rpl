<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 form-card">
                <h3 class="form-title">Form Tambah Ekstrakurikuler</h3>

                <form action="{{ route('ekstrakurikulers.store') }}" method="POST">
                    @csrf
                    
                    {{-- Nama Ekstrakurikuler --}}
                    <div class="mb-4 form-group">
                        <label>Nama Ekstrakurikuler <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_extra" value="{{ old('nama_extra') }}" required placeholder="Contoh: Basket, Pramuka, PMR">
                        @error('nama_extra')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pembina --}}
                    <div class="mb-4 form-group">
                        <label>Pembina <span class="text-red-500">*</span></label>
                        <select name="pembina_id" required>
                            <option value="">-- Pilih Pembina --</option>
                            @foreach($pembinas as $p)
                                <option value="{{ $p->id }}" {{ old('pembina_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembina_id')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kuota --}}
                    <div class="mb-4 form-group">
                        <label>Kuota Peserta <span class="text-red-500">*</span></label>
                        <input type="number" name="kuota" value="{{ old('kuota') }}" required min="1" placeholder="Masukkan jumlah kuota">
                        @error('kuota')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <small class="text-gray-500">Minimal 1 orang</small>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4 form-group">
                        <label>Deskripsi (opsional)</label>
                        <textarea name="deskripsi" rows="4" placeholder="Jelaskan tentang ekstrakurikuler ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Section: Jadwal --}}
                    <div class="section-divider">
                        <span>Jadwal Kegiatan</span>
                    </div>

                    {{-- Hari --}}
                    <div class="mb-4 form-group">
                        <label>Hari <span class="text-red-500">*</span></label>
                        <select name="hari" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                        @error('hari')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jam Mulai & Jam Selesai --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="form-group">
                            <label>Jam Mulai <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jam Selesai <span class="text-red-500">*</span></label>
                            <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tempat --}}
                    <div class="mb-4 form-group">
                        <label>Tempat <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat" value="{{ old('tempat') }}" required placeholder="Contoh: Lapangan Basket, Ruang OSIS">
                        @error('tempat')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Section: Periode Pendaftaran --}}
                    <div class="section-divider">
                        <span>Periode Pendaftaran</span>
                    </div>

                    {{-- Pendaftaran Mulai & Selesai --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="form-group">
                            <label>Pendaftaran Mulai <span class="text-red-500">*</span></label>
                            <input type="date" name="pendaftaran_mulai" value="{{ old('pendaftaran_mulai') }}" required>
                            @error('pendaftaran_mulai')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pendaftaran Selesai <span class="text-red-500">*</span></label>
                            <input type="date" name="pendaftaran_selesai" value="{{ old('pendaftaran_selesai') }}" required>
                            @error('pendaftaran_selesai')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="button-group">
                        <button type="submit" class="btn-primary">Simpan</button>
                        <a href="{{ route('ekstrakurikulers.index') }}" class="btn-back">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Background & Font */
        body {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
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
            font-size: 24px;
            font-weight: 700;
            color: #dc2626;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #dc2626;
        }

        /* Section Divider */
        .section-divider {
            margin: 30px 0 20px 0;
            text-align: center;
            position: relative;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #d1d5db;
        }

        .section-divider::before {
            left: 0;
        }

        .section-divider::after {
            right: 0;
        }

        .section-divider span {
            background: #fafafa;
            padding: 0 15px;
            font-weight: 600;
            color: #374151;
            font-size: 16px;
        }

        /* Input & Label */
        .form-group label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #bbb;
            border-radius: 8px;
            font-size: 15px;
            background-color: #fff;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9ca3af;
            font-style: italic;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #dc2626;
            outline: none;
            box-shadow: 0 0 8px rgba(220, 38, 38, 0.2);
            background-color: #fff;
        }

        /* Textarea */
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Grid Layout */
        .grid {
            display: grid;
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .gap-4 {
            gap: 16px;
        }

        /* Tombol */
        .button-group {
            text-align: right;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-back {
            display: inline-block;
            color: #374151;
            background: white;
            border: 2px solid #d1d5db;
            margin-left: 10px;
            padding: 10px 26px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 15px;
        }

        .btn-back:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
            transform: translateY(-2px);
        }

        /* Error Text */
        .text-red-500 {
            color: #dc2626 !important;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }
        
        /* Text bantuan */
        .text-gray-500 {
            color: #6b7280;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .form-title {
                font-size: 20px;
            }

            .button-group {
                text-align: center;
            }

            .btn-primary,
            .btn-back {
                width: 100%;
                margin: 5px 0;
            }

            .section-divider::before,
            .section-divider::after {
                width: 30%;
            }
        }
    </style>
</x-app-layout>