<x-app-layout>
    <style>
        :root {
            --red-elite: #991b1b;
            --gold-elite: #d4af37;
            --bg-light: #fdfcfb;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(to bottom, var(--bg-light) 0%, #f9f6f3 100%);
            color: #1f2937;
        }

        /* Animasi */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .animate-fade-in {
            animation: fade-in-up 0.6s ease-out forwards;
        }

        .animate-bounce-slow {
            animation: bounce-slow 2.2s infinite;
        }

        /* Elite Card */
        .elite-card {
            background: white;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 6px 25px -10px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0e6e0;
            opacity: 0;
            animation: fade-in-up 0.7s ease-out forwards;
            animation-delay: calc(var(--delay, 0) * 0.15s);
            transition: all 0.35s cubic-bezier(0.22, 0.61, 0.36, 1);
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
            background: linear-gradient(90deg, var(--red-elite), var(--gold-elite));
            background-size: 200% 100%;
            animation: shimmer 3s infinite linear;
        }

        .elite-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px -12px rgba(0, 0, 0, 0.15);
        }

        /* Section Title */
        .section-title {
            font-family: 'Georgia', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--red-elite);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #fecaca;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Info Item */
        .info-item {
            display: flex;
            margin-bottom: 14px;
            font-size: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            min-width: 110px;
        }

        .info-value {
            color: #1f2937;
            flex: 1;
        }

        /* Student Badge */
        .student-badge {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 14px;
            border: 1px solid #fbbf24;
            margin-bottom: 20px;
        }

        .student-avatar {
            width: 54px;
            height: 54px;
            background: linear-gradient(135deg, var(--red-elite), #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 700;
            color: white;
            box-shadow: 0 4px 10px rgba(153, 27, 27, 0.3);
        }

        .student-info h4 {
            font-size: 17px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .student-info p {
            font-size: 13px;
            color: #6b7280;
            margin: 2px 0 0 0;
        }

        /* Download Button */
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .btn-download-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-download-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        }

        /* Status Badge */
        .status-graded {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            padding: 16px 20px;
            border-radius: 14px;
            border: 2px solid #6ee7b7;
            font-size: 15px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
        }

        .status-graded svg {
            flex-shrink: 0;
            margin-top: 2px;
        }

        .status-graded strong {
            font-size: 16px;
        }

        /* Form Input */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14.5px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--red-elite);
            background: white;
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 100px;
        }

        /* Buttons */
        .btn {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--red-elite) 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(153, 27, 27, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(153, 27, 27, 0.35);
            background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(107, 114, 128, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .elite-card {
                padding: 22px;
            }

            .section-title {
                font-size: 1.15rem;
            }

            .student-badge {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                
                <!-- Detail Tugas -->
                <div class="elite-card" style="--delay: 1;">
                    <h3 class="section-title">
                        📋 Detail Tugas
                    </h3>

                    <div class="info-item">
                        <span class="info-label">Judul:</span>
                        <span class="info-value font-semibold">{{ $pengumpulan->tugas->judul_tugas }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Mata Pelajaran:</span>
                        <span class="info-value">{{ $pengumpulan->tugas->mapel->nama_mapel }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Kelas:</span>
                        <span class="info-value">{{ $pengumpulan->tugas->kelas->nama_kelas }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Guru:</span>
                        <span class="info-value">{{ $pengumpulan->tugas->guru->user->name }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Deadline:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($pengumpulan->tugas->deadline)->translatedFormat('l, d F Y • H:i') }} WIB</span>
                    </div>

                    <div class="mt-5 pt-5 border-t border-gray-200">
                        <p class="font-semibold text-gray-700 mb-2">Deskripsi:</p>
                        <p class="text-gray-600 leading-relaxed">{{ $pengumpulan->tugas->deskripsi }}</p>
                    </div>

                    @if($pengumpulan->tugas->file_tugas)
                        <div class="mt-5">
                            <a href="{{ route('tugas.download', $pengumpulan->tugas) }}" class="btn-download">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download Soal
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm mt-4 italic">Tidak ada file soal</p>
                    @endif
                </div>

                <!-- Hasil Tugas Siswa -->
                <div class="elite-card" style="--delay: 2;">
                    <h3 class="section-title">
                        Hasil Pengumpulan
                    </h3>

                    <div class="student-badge">
                        <div class="student-avatar">
                            {{ strtoupper(substr($pengumpulan->siswa->user->name, 0, 1)) }}
                        </div>
                        <div class="student-info">
                            <h4>{{ $pengumpulan->siswa->user->name }}</h4>
                            <p>NIS: {{ $pengumpulan->siswa->username }}</p>
                            <p class="text-xs mt-1">📅 Diupload: {{ $pengumpulan->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    @if($pengumpulan->file_pengumpulan)
                        <a href="{{ route('pengumpulan.downloadFile', $pengumpulan) }}" class="btn-download btn-download-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            Download Jawaban Siswa
                        </a>
                    @else
                        <p class="text-gray-500 text-sm italic">Siswa belum mengunggah file</p>
                    @endif

                    @if($pengumpulan->catatan)
                        <div class="mt-5 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="font-semibold text-blue-900 mb-1 text-sm">Deskripsi</p>
                            <p class="text-blue-800 text-sm italic">"{{ $pengumpulan->catatan }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- PENILAIAN - HANYA UNTUK GURU -->
            @if(auth()->user()->guru)
                <div class="elite-card" style="--delay: 3;">
                    <h3 class="section-title">
                        Penilaian Tugas
                    </h3>

                    @if($pengumpulan->nilai !== null)
                        <div class="status-graded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <strong>Tugas Sudah Dinilai!</strong><br>
                                <span class="text-2xl font-bold">Nilai: {{ $pengumpulan->nilai }}/100</span>
                                @if($pengumpulan->catatan_guru)
                                    <p class="mt-2 text-sm">
                                        <strong>Catatan Guru:</strong> <em>"{{ $pengumpulan->catatan_guru }}"</em>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @else
                        <form action="{{ route('pengumpulan.nilai', $pengumpulan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nilai" class="form-label">Nilai (0-100)</label>
                                <input type="number" name="nilai" id="nilai" min="0" max="100"
                                       value="{{ old('nilai') }}"
                                       class="form-input"
                                       placeholder="Masukkan nilai siswa..."
                                       required>
                                @error('nilai')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan_guru" class="form-label">Catatan Guru (Opsional)</label>
                                <textarea name="catatan_guru" id="catatan_guru"
                                          class="form-input"
                                          placeholder="Berikan feedback untuk siswa...">{{ old('catatan_guru') }}</textarea>
                                @error('catatan_guru')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Simpan Nilai
                            </button>
                        </form>
                    @endif
                </div>
            @else
                <!-- TAMPILAN UNTUK SISWA -->
                <div class="elite-card" style="--delay: 3;">
                    <h3 class="section-title">
                        📊 Status Penilaian
                    </h3>

                    @if($pengumpulan->nilai !== null)
                        <div class="status-graded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <strong>Tugas Anda Sudah Dinilai!</strong><br>
                                <span class="text-3xl font-bold">Nilai: {{ $pengumpulan->nilai }}/100</span>
                                @if($pengumpulan->catatan_guru)
                                    <p class="mt-3 text-sm">
                                        <strong>Catatan dari Guru:</strong><br>
                                        <em>"{{ $pengumpulan->catatan_guru }}"</em>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="p-6 bg-amber-50 border-2 border-amber-200 rounded-lg text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-amber-500 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-amber-800 font-semibold text-lg">Menunggu Penilaian</p>
                            <p class="text-amber-700 text-sm mt-2">Tugas Anda sedang diperiksa oleh guru. Mohon bersabar</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="mt-8 elite-card" style="--delay: 4;">
                <a href="{{ auth()->user()->guru ? route('tugas.index') : route('tugas.by.mapel', $pengumpulan->tugas->mapel) }}"
                   class="btn btn-secondary">
                     Kembali ke Daftar Tugas
                </a>
            </div>

        </div>
    </div>
</x-app-layout>