<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            color: #1f2937;
        }

        .elite-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.1);
            padding: 24px;
            margin-bottom: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .elite-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #b91c1c, #d97706);
        }

        .elite-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px -15px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 18px;
            padding-bottom: 10px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #b91c1c, #d97706);
            border-radius: 2px;
        }

        .profile-photo-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 16px;
            cursor: pointer;
        }

        .profile-photo, .profile-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fef3c7;
            display: block;
            box-shadow: 0 8px 20px rgba(185, 28, 28, 0.15);
            transition: all 0.3s ease;
        }

        .profile-placeholder {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b91c1c;
            font-size: 40px;
        }

        .profile-photo-wrapper:hover .profile-photo,
        .profile-photo-wrapper:hover .profile-placeholder {
            transform: scale(1.05);
            border-color: #fcd34d;
            box-shadow: 0 12px 30px rgba(185, 28, 28, 0.25);
        }

        /* Modal Zoom */
        .photo-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.95);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .photo-modal-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 85vh;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: zoomIn 0.3s ease;
        }

        @keyframes zoomIn {
            from { 
                transform: scale(0.7);
                opacity: 0;
            }
            to { 
                transform: scale(1);
                opacity: 1;
            }
        }

        .photo-modal-close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #fff;
            font-size: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 10000;
        }

        .photo-modal-close:hover,
        .photo-modal-close:focus {
            color: #fcd34d;
            transform: rotate(90deg);
        }

        /* 🔥 PROFILE INFO ITEM - RAPI ICON & TEXT */
        .profile-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s ease;
            border-radius: 8px;
        }

        .profile-info-item:hover {
            background: #fafafa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .profile-info-label {
            min-width: 180px;
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px; /* 🔥 GAP ANTARA ICON & TEXT */
        }

        .profile-info-label i {
            width: 18px; /* 🔥 FIXED WIDTH ICON */
            text-align: center;
            color: #b91c1c;
            font-size: 14px;
            flex-shrink: 0;
        }

        .profile-info-value {
            flex: 1;
            color: #1f2937;
            font-weight: 500;
            font-size: 14px;
            padding-left: 12px;
        }

        /* Password Toggle */
        .password-input-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s ease;
            font-size: 18px;
        }

        .password-toggle:hover {
            color: #b91c1c;
        }

        .form-input {
            width: 100%;
            padding: 10px 40px 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #b91c1c;
            box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.1);
        }

        /* 🔥 LABEL RAPI */
        .label {
            display: flex;
            align-items: center;
            gap: 8px; /* 🔥 GAP ANTARA ICON & TEXT */
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .label i {
            width: 16px;
            text-align: center;
            color: #b91c1c;
            font-size: 13px;
        }

        .alert-success, .alert-danger {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 500;
            animation: slideDown 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .btn-primary {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(185, 28, 28, 0.4);
        }

        .btn-primary:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Password Requirements */
        .password-requirements {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            margin-top: 8px;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 10px; /* 🔥 GAP ANTARA ICON & TEXT */
            padding: 6px 0;
            font-size: 13px;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .requirement-icon {
            width: 12px;
            font-size: 8px;
            color: #d1d5db;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .requirement-item.valid {
            color: #059669;
        }

        .requirement-item.valid .requirement-icon {
            color: #10b981;
        }

        .requirement-item.invalid {
            color: #dc2626;
        }

        .requirement-item.invalid .requirement-icon {
            color: #ef4444;
        }

        .password-match-success {
            color: #059669;
            font-weight: 500;
            font-size: 13px;
        }

        .password-match-error {
            color: #dc2626;
            font-weight: 500;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .elite-card { 
                padding: 20px 16px; 
            }
            .profile-info-label { 
                min-width: 140px; 
                font-size: 13px; 
            }
            .photo-modal-content { 
                max-width: 95%; 
            }
            .photo-modal-close { 
                font-size: 40px; 
                right: 20px; 
                top: 15px; 
            }
        }
    </style>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ALERT NOTIFIKASI --}}
            @if (session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- === IDENTITAS AKADEMIK === --}}
            <div class="elite-card">
                <h4 class="section-title">Identitas Akademik</h4>

                <div class="text-center mb-5">
                    <div class="profile-photo-wrapper" onclick="openModal()">
                        @if (!empty($profile->foto_profile))
                            <img src="{{ asset('storage/' . $profile->foto_profile) }}" alt="Foto Profil" class="profile-photo" id="profileImage">
                        @else
                            <div class="profile-placeholder" id="profilePlaceholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="font-bold text-lg text-gray-900">{{ $user->name }}</h5>
                    <span class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded-full text-sm font-medium mt-2">
                        {{ ucfirst($role) }}
                    </span>
                </div>

                <div class="max-w-2xl mx-auto">
                    <div class="profile-info-item">
                        <div class="profile-info-label">
                            <i class="fas fa-envelope"></i>
                            <span>Email</span>
                        </div>
                        <div class="profile-info-value">{{ $user->email }}</div>
                    </div>

                    <div class="profile-info-item">
                        <div class="profile-info-label">
                            <i class="fas fa-id-badge"></i>
                            <span>
                                @php
                                    $label = match($role) {
                                        'siswa' => 'NISN',
                                        'guru', 'kepsek', 'tus' => 'NIP',
                                        'orangtua' ,'pembina' => 'No HP',
                                        default => 'Username'
                                    };
                                @endphp
                                {{ $label }}
                            </span>
                        </div>
                        <div class="profile-info-value">{{ $user->username }}</div>
                    </div>

                    @if (in_array($role, ['superadmin','siswa', 'guru', 'orangtua', 'tus', 'kepsek','pembina']))
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Alamat</span>
                            </div>
                            <div class="profile-info-value">{{ $profile->alamat ?? '-' }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="fas fa-calendar-day"></i>
                                <span>Tanggal Lahir</span>
                            </div>
                            <div class="profile-info-value">{{ $profile->tanggal_lahir ?? '-' }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="fas fa-venus-mars"></i>
                                <span>Jenis Kelamin</span>
                            </div>
                            <div class="profile-info-value">{{ $profile->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="fas fa-praying-hands"></i>
                                <span>Agama</span>
                            </div>
                            <div class="profile-info-value">{{ $profile->agama ?? '-' }}</div>
                        </div>
                    @endif

                    @if ($role === 'siswa')
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="fas fa-school"></i>
                                <span>Kelas</span>
                            </div>
                            <div class="profile-info-value">{{ $profile->kelas->nama_kelas ?? '-' }}</div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-label">
                                <i class="fas fa-book"></i>
                                <span>Jurusan</span>
                            </div>
                            <div class="profile-info-value">{{ $profile->kelas->jurusan->nama_jurusan ?? '-' }}</div>
                        </div>
                    @endif
                </div>
            </div>

<!-- LANJUT KE BAGIAN 2 -->
{{-- === FORM EDIT PROFIL === --}}
            <div class="elite-card">
                <h4 class="section-title">Edit Profil</h4>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        @php
                            $currentRole = strtolower(auth()->user()->roles->pluck('name')->first());
                            $isSuperAdmin = $currentRole === 'superadmin';
                        @endphp
                        
                        @if($isSuperAdmin)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $label }}
                            </label>
                            <input 
                                type="text" 
                                name="username" 
                                value="{{ old('username', $user->username) }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                                required>
                        </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                            <input type="file" name="foto_profile" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <input type="text" name="alamat" value="{{ old('alamat', $profile->alamat ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" max="2010-12-31" value="{{ old('tanggal_lahir', $profile->tanggal_lahir ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select name="agama" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
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
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- === UBAH PASSWORD === --}}
            <div class="elite-card">
                <h4 class="section-title">Ubah Password</h4>
                <form action="{{ route('password.update') }}" method="POST" id="passwordForm">
                    @csrf 
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="label">
                                <i class="fas fa-lock"></i>
                                <span>Password Saat Ini</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="current_password" id="currentPassword" class="form-input" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('currentPassword', this)"></i>
                            </div>
                        </div>

                        <div>
                            <label class="label">
                                <i class="fas fa-key"></i>
                                <span>Password Baru</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="password" id="newPassword" class="form-input" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('newPassword', this)"></i>
                            </div>
                            
                            {{-- Password Strength Indicator --}}
                            <div class="password-requirements">
                                <div class="requirement-item" id="req-length">
                                    <i class="fas fa-circle requirement-icon"></i>
                                    <span>Minimal 8 karakter</span>
                                </div>
                                <div class="requirement-item" id="req-lowercase">
                                    <i class="fas fa-circle requirement-icon"></i>
                                    <span>Huruf kecil (a-z)</span>
                                </div>
                                <div class="requirement-item" id="req-uppercase">
                                    <i class="fas fa-circle requirement-icon"></i>
                                    <span>Huruf besar (A-Z)</span>
                                </div>
                                <div class="requirement-item" id="req-number">
                                    <i class="fas fa-circle requirement-icon"></i>
                                    <span>Angka (0-9)</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="label">
                                <i class="fas fa-check-circle"></i>
                                <span>Konfirmasi Password Baru</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" name="password_confirmation" id="confirmPassword" class="form-input" required>
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword', this)"></i>
                            </div>
                            <div id="password-match-message" class="mt-2"></div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="btn-primary" id="submitBtn" disabled>
                            <i class="fas fa-shield-alt"></i>
                            <span>Simpan Password</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- Modal Zoom Foto --}}
    <div id="photoModal" class="photo-modal" onclick="closeModal()">
        <span class="photo-modal-close" onclick="closeModal()">&times;</span>
        <img class="photo-modal-content" id="modalImage">
    </div>

    <script>
        // 🔥 === TOGGLE PASSWORD VISIBILITY ===
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // 🔥 === MODAL ZOOM FOTO ===
        function openModal() {
            const modal = document.getElementById("photoModal");
            const modalImg = document.getElementById("modalImage");
            const profileImg = document.getElementById("profileImage");
            
            modal.style.display = "block";
            
            if (profileImg) {
                modalImg.src = profileImg.src;
            } else {
                modalImg.src = "{{ asset('default-profile.png') }}";
            }
        }

        function closeModal() {
            const modal = document.getElementById("photoModal");
            modal.style.display = "none";
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // 🔥 === PASSWORD VALIDATION ===
        const newPasswordInput = document.getElementById('newPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const submitBtn = document.getElementById('submitBtn');
        const matchMessage = document.getElementById('password-match-message');

        let requirements = {
            length: false,
            lowercase: false,
            uppercase: false,
            number: false
        };

        if (newPasswordInput) {
            newPasswordInput.addEventListener('input', function() {
                const password = this.value;

                // Check length
                requirements.length = password.length >= 8;
                toggleRequirement('req-length', requirements.length);

                // Check lowercase
                requirements.lowercase = /[a-z]/.test(password);
                toggleRequirement('req-lowercase', requirements.lowercase);

                // Check uppercase
                requirements.uppercase = /[A-Z]/.test(password);
                toggleRequirement('req-uppercase', requirements.uppercase);

                // Check number
                requirements.number = /[0-9]/.test(password);
                toggleRequirement('req-number', requirements.number);

                checkPasswordMatch();
                updateSubmitButton();
            });
        }

        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        }

        function toggleRequirement(id, isValid) {
            const element = document.getElementById(id);
            if (element) {
                element.classList.remove('valid', 'invalid');
                element.classList.add(isValid ? 'valid' : 'invalid');
            }
        }

        function checkPasswordMatch() {
            if (!newPasswordInput || !confirmPasswordInput || !matchMessage) return;

            const newPass = newPasswordInput.value;
            const confirmPass = confirmPasswordInput.value;

            if (confirmPass.length === 0) {
                matchMessage.textContent = '';
                matchMessage.className = '';
            } else if (newPass === confirmPass) {
                matchMessage.textContent = '✓ Password cocok';
                matchMessage.className = 'password-match-success';
            } else {
                matchMessage.textContent = '✗ Password tidak cocok';
                matchMessage.className = 'password-match-error';
            }

            updateSubmitButton();
        }

        function updateSubmitButton() {
            if (!submitBtn) return;

            const allValid = Object.values(requirements).every(req => req === true);
            const passwordsMatch = newPasswordInput.value === confirmPasswordInput.value;
            const confirmNotEmpty = confirmPasswordInput.value.length > 0;

            submitBtn.disabled = !(allValid && passwordsMatch && confirmNotEmpty);
        }

        // 🔥 === PREVIEW FOTO UPLOAD ===
        document.addEventListener("DOMContentLoaded", function () {
            const inputFoto = document.querySelector('input[name="foto_profile"]');
            const profilePreview = document.getElementById('profileImage'); 
            const headerImg = document.getElementById('headerProfileImage');
            const defaultHeaderIcon = document.getElementById('headerProfileImageDefault');

            if (inputFoto) {
                inputFoto.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            if (profilePreview) {
                                profilePreview.src = e.target.result;
                                profilePreview.style.display = 'block';
                            }

                            if (headerImg) {
                                headerImg.src = e.target.result;
                                headerImg.style.display = 'block';
                            }

                            if (defaultHeaderIcon) {
                                defaultHeaderIcon.style.display = 'none';
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });

        // 🔥 === USERNAME VALIDATION (NUMERIC ONLY FOR CERTAIN ROLES) ===
        document.addEventListener("DOMContentLoaded", function () {
            const usernameInput = document.querySelector('input[name="username"]');
            const role = "{{ $role }}";
            const numericRoles = ['siswa', 'guru', 'kepsek', 'tus', 'orangtua','pembina'];

            if (usernameInput && numericRoles.includes(role)) {
                // Only allow numbers
                usernameInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Max length based on role
                    const maxLength = role === 'orangtua' ? 15 : 20;
                    if (this.value.length > maxLength) {
                        this.value = this.value.slice(0, maxLength);
                    }
                });

                // Handle paste
                usernameInput.addEventListener('paste', function(e) {
                    setTimeout(() => {
                        this.value = this.value.replace(/[^0-9]/g, '');
                    }, 10);
                });

                // Form validation
                const form = usernameInput.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const value = usernameInput.value;
                        
                        // Check if numeric
                        if (!/^\d+$/.test(value)) {
                            e.preventDefault();
                            alert('Username harus berupa angka saja!');
                            usernameInput.focus();
                            return false;
                        }

                        // Check minimum length
                        const minLength = ['guru', 'kepsek', 'tu'].includes(role) ? 18 : 10;
                        if (value.length < minLength) {
                            e.preventDefault();
                            let label = role === 'siswa' ? 'NISN' : (role === 'orangtua' ,'pembina' ? 'Nomor HP' : 'NIP');
                            alert(`${label} minimal ${minLength} digit!`);
                            usernameInput.focus();
                            return false;
                        }

                        // Check exact length for NIP
                        if (['guru', 'kepsek', 'tu'].includes(role) && value.length !== 18) {
                            e.preventDefault();
                            alert('NIP harus tepat 18 digit!');
                            usernameInput.focus();
                            return false;
                        }
                    });
                }
            }
        });
    </script>

</x-app-layout>