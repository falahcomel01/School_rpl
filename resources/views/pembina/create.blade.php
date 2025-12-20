<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6 form-card">
                <h3 class="form-title">Form Tambah Data Pembina</h3>

                <form action="{{ route('pembina.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Pembina -->
                    <div class="mb-4 form-group">
                        <label>Nama Pembina <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-4 form-group">
                        <label>Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4 form-group">
                        <label>Email (opsional)</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4 form-group">
                        <label>Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required minlength="5">
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <small class="text-gray-500">Minimal 5 karakter</small>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-4 form-group">
                        <label>Jenis Kelamin (opsional)</label>
                        <select name="jenis_kelamin" class="w-full">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="button-group">
                        <button type="submit" class="btn-primary">Simpan</button>
                        <a href="{{ route('pembina.index') }}" class="btn-back">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* 🌈 Background & Font */
        body {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Judul Halaman */
        .page-title {
            text-align: center;
            color: #dc2626;
            font-weight: 700;
            font-size: 28px;
            margin-top: 30px;
            letter-spacing: 0.5px;
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
            font-size: 20px;
            font-weight: 600;
            color: #dc2626;
            margin-bottom: 25px;
        }

        /* Input & Label */
        .form-group label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #bbb;
            border-radius: 8px;
            font-size: 15px;
            background-color: #f9fafb;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #dc2626;
            outline: none;
            box-shadow: 0 0 6px rgba(220, 38, 38, 0.3);
        }

        /* Tombol */
        .button-group {
            text-align: right;
            margin-top: 25px;
        }

        .btn-primary {
            background: #dc2626;
            color: white;
            font-weight: 600;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #b91c1c;
            transform: scale(1.03);
        }

        .btn-back {
            display: inline-block;
            color: #111;
            background: white;
            border: 1.8px solid #111;
            margin-left: 10px;
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #111;
            color: white;
        }

        /* Error Text */
        .text-red-500 {
            color: #dc2626 !important;
            font-size: 13px;
            margin-top: 4px;
        }
        
        /* Text bantuan */
        .text-gray-500 {
            color: #6b7280;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        /* Textarea */
        textarea {
            resize: vertical;
            min-height: 80px;
        }
    </style>
</x-app-layout>