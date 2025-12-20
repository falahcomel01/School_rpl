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

        @keyframes pulse-scale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
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

        /* Task Detail Card */
        .task-detail-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 14px;
            padding: 24px;
            border: 1px solid #fbbf24;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
        }

        .task-detail-card h4 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .task-description {
            color: #78350f;
            font-size: 14px;
            line-height: 1.7;
            background: rgba(255, 255, 255, 0.5);
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
        }

        /* File Download Box */
        .file-box {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .file-box:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .file-name {
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }

        .btn-download-file {
            padding: 8px 18px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
        }

        .btn-download-file:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        /* Upload Zone */
        .upload-zone {
            border: 3px dashed #d1d5db;
            border-radius: 14px;
            padding: 40px 20px;
            text-align: center;
            background: #fafafa;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .upload-zone:hover {
            border-color: var(--red-elite);
            background: #fef2f2;
            transform: scale(1.02);
        }

        .upload-zone.dragover {
            border-color: var(--red-elite);
            background: #fee2e2;
            animation: pulse-scale 0.5s ease-in-out;
        }

        .upload-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, var(--red-elite), #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(153, 27, 27, 0.3);
        }

        .upload-text {
            font-size: 15px;
            color: #6b7280;
            font-weight: 500;
        }

        .upload-hint {
            font-size: 13px;
            color: #9ca3af;
            margin-top: 8px;
        }

        .file-selected {
            margin-top: 16px;
            padding: 12px;
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            border-radius: 10px;
            color: #065f46;
            font-weight: 600;
            display: none;
        }

        /* Form Textarea */
        .form-textarea {
            width: 100%;
            padding: 14px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            resize: vertical;
            min-height: 110px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--red-elite);
            background: white;
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        /* Buttons */
        .btn {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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

        /* Label */
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
            font-size: 14.5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .elite-card {
                padding: 22px;
            }

            .section-title {
                font-size: 1.15rem;
            }

            .task-detail-card {
                padding: 18px;
            }

            .upload-zone {
                padding: 30px 15px;
            }
        }
    </style>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="elite-card" style="--delay: 1;">
                <!-- Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- Kolom Kiri: Detail Tugas -->
                    <div>
                        <h3 class="section-title">
                            📋 Detail Tugas
                        </h3>

                        <div class="task-detail-card">
                            <h4>
                                📚 {{ $tugas->judul_tugas }}
                            </h4>
                            
                            <div class="task-description">
                                {{ $tugas->deskripsi }}
                            </div>

                            @if($tugas->file_tugas)
                                <div class="file-box">
                                    <div class="file-info">
                                        <div class="file-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="file-name">Soal_{{ Str::slug($tugas->judul_tugas) }}.pdf</div>
                                            <div class="text-xs text-gray-500">File soal dari guru</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('tugas.download', $tugas) }}" class="btn-download-file">
                                         Download
                                    </a>
                                </div>
                            @else
                                <p class="text-xs text-gray-500 mt-4 italic text-center">
                                    Tidak ada file soal yang dilampirkan
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Kanan: Upload File Siswa -->
                    <div>
                        <h3 class="section-title">
                        Upload Jawaban Anda
                        </h3>

                        <form action="{{ route('pengumpulan.store.tugas', $tugas) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf

                            <div class="mb-6">
                                <label for="file_pengumpulan" class="form-label">
                                    📎 File Jawaban (PDF/WORD/ZIP)
                                </label>
                                <div class="upload-zone" id="uploadZone">
                                    <label for="file_pengumpulan" class="cursor-pointer block">
                                        <div class="upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>
                                        <div class="upload-text">
                                            Klik untuk memilih file atau seret file ke sini
                                        </div>
                                        <div class="upload-hint">
                                            Format yang didukung: PDF, DOC, DOCX, ZIP (Maks. 10MB)
                                        </div>
                                        <input type="file" 
                                               name="file_pengumpulan" 
                                               id="file_pengumpulan" 
                                               required 
                                               class="hidden" 
                                               accept=".pdf,.doc,.docx,.zip">
                                    </label>
                                </div>
                                <div class="file-selected" id="fileSelected">
                                    ✓ File terpilih: <span id="fileName"></span>
                                </div>
                                @error('file_pengumpulan')
                                    <p class="text-red-600 text-sm mt-2">⚠️ {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="catatan" class="form-label">
                                   Deskripsi
                                </label>
                                <textarea name="catatan" 
                                          id="catatan" 
                                          class="form-textarea"
                                          placeholder="Tambahkan Deskripsi tentang jawaban Anda...">{{ old('catatan') }}</textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3">
                                <a href="{{ route('tugas.by.mapel', $tugas->mapel) }}"
                                   class="btn btn-secondary justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                    Upload Jawaban
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        // File Upload Interaction
        const fileInput = document.getElementById('file_pengumpulan');
        const uploadZone = document.getElementById('uploadZone');
        const fileSelected = document.getElementById('fileSelected');
        const fileName = document.getElementById('fileName');

        // File selection
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;
                fileSelected.style.display = 'block';
                uploadZone.style.borderColor = '#10b981';
                uploadZone.style.background = '#d1fae5';
            }
        });

        // Drag and drop
        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileName.textContent = files[0].name;
                fileSelected.style.display = 'block';
                uploadZone.style.borderColor = '#10b981';
                uploadZone.style.background = '#d1fae5';
            }
        });
    </script>
</x-app-layout>