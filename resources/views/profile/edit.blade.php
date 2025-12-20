<h4 class="section-title">Perbarui Data Pribadi</h4>

<style>
    .form-label {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label i {
        margin-right: 6px;
        color: #b91c1c;
        font-size: 13px;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #b91c1c;
        box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.12);
        background: white;
    }

    .upload-btn {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 12px;
        transition: all 0.35s cubic-bezier(0.22, 0.61, 0.36, 1);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }

    .upload-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .upload-btn:hover {
        background: linear-gradient(135deg, #1d4ed8, #60a5fa);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(59, 130, 246, 0.4);
    }

    .upload-btn:hover::before {
        left: 100%;
    }

    .file-input {
        display: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #b91c1c, #991b1b);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 6px 16px rgba(185, 28, 28, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #991b1b, #7f1d1d);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(185, 28, 28, 0.4);
    }

    @media (max-width: 768px) {
        .grid { grid-template-columns: 1fr !important; }
    }
</style>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Foto Profil -->
    <div class="text-center mb-5">
        <div class="inline-block">
            @if (!empty($profile->foto_profile))
                <img src="{{ asset('storage/' . $profile->foto_profile) }}" alt="Foto Profil" class="profile-photo">
            @else
                <div class="profile-placeholder">
                    <i class="fas fa-user"></i>
                </div>
            @endif
        </div>
        <br>
        <label class="cursor-pointer">
            <span class="upload-btn">
                <i class="fas fa-camera"></i> Ganti Foto Profil
            </span>
            <input type="file" name="foto_profile" class="file-input">
        </label>
    </div>

    <!-- Data Umum -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
        <div>
            <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', Auth::user()->name) }}" required>
        </div>
        <div>
            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', Auth::user()->email) }}" required>
        </div>
    </div>

    <!-- Username -->
    <div class="mb-5">
        <label class="form-label">
            <i class="fas fa-id-badge"></i> {{ $label }}
        </label>
        <input type="text" name="username" class="form-control"
               value="{{ old('username', Auth::user()->username) }}" required>
    </div>

    <!-- Data Tambahan -->
    @if (in_array($role, ['siswa', 'guru', 'orang tua']))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
            <div>
                <label class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                <input type="text" name="alamat" class="form-control"
                       value="{{ old('alamat', $profile->alamat ?? '') }}">
            </div>
      <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
    <input 
        type="date" 
        name="tanggal_lahir"
        max="2015-12-31"
        value="{{ old('tanggal_lahir', $profile->tanggal_lahir ?? '') }}"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
    <small class="text-gray-500 text-xs">Tanggal maksimal: 31 Desember 2015</small>
</div>

            <div>
                <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <!-- Tambahan Agama -->
        <div class="mb-5">
            <label class="form-label"><i class="fas fa-praying-hands"></i> Agama</label>
            <select name="agama" class="form-select">
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" {{ old('agama', $profile->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $profile->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $profile->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $profile->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $profile->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $profile->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                <option value="Lainnya" {{ old('agama', $profile->agama ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        @if ($role === 'siswa')
            <div class="mb-5">
                <label class="form-label"><i class="fas fa-school"></i> Kelas</label>
                <select name="kelas_id" class="form-select">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach (\App\Models\Kelas::all() as $kelas)
                        <option value="{{ $kelas->id }}" {{ old('kelas_id', $profile->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
    @endif

    <!-- Tombol Simpan -->
    <div class="text-center">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </div>
</form>


<script>
    @if(session('success'))
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => location.reload(), 1500);
        });
    @endif
</script>
