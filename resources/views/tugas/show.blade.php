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
        margin-bottom: 24px;
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

    /* Task Info Box */
    .task-info-box {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: 14px;
        padding: 24px;
        border: 1px solid #fbbf24;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
        margin-bottom: 24px;
    }

    .info-row {
        display: flex;
        margin-bottom: 12px;
        font-size: 14.5px;
    }

    .info-label {
        font-weight: 700;
        color: #92400e;
        min-width: 120px;
    }

    .info-value {
        color: #78350f;
        flex: 1;
    }

    .task-description {
        background: rgba(255, 255, 255, 0.6);
        padding: 14px;
        border-radius: 10px;
        margin-top: 12px;
        color: #78350f;
        font-size: 14px;
        line-height: 1.6;
    }

    /* File Download Box */
    .file-download-box {
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

    .file-download-box:hover {
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
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-download-file:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
    }

    /* Stats Bar */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-box {
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-radius: 12px;
        padding: 18px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--red-elite);
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
    }

    /* Student Card */
    .student-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 22px;
        border-radius: 14px;
        margin-bottom: 12px;
        background: #fafafa;
        border: 2px solid #f5f5f5;
        transition: all 0.3s ease;
    }

    .student-card:hover {
        background: white;
        border-color: #fbbfbf;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    /* -------------------- FIX AVATAR BULAT --------------------- */

    .student-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        overflow: hidden;
        background: linear-gradient(135deg, var(--red-elite), #dc2626);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        color: white;
        box-shadow: 0 3px 8px rgba(153, 27, 27, 0.3);
    }

    .student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    /* ----------------------------------------------------------- */

    .student-details .student-name {
        font-weight: 700;
        color: #1f2937;
        font-size: 15.5px;
        display: block;
    }

    .student-details .student-nis {
        font-size: 13px;
        color: #6b7280;
        margin-top: 2px;
    }

    .student-controls {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .score-badge {
        min-width: 80px;
        text-align: center;
        font-weight: 700;
        font-size: 15px;
        padding: 8px 14px;
        border-radius: 10px;
    }

    .score-badge.submitted {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border: 1px solid #93c5fd;
    }

    .score-badge.graded {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #6ee7b7;
    }

    .score-badge.missing {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: var(--red-elite);
        border: 1px solid #fca5a5;
        font-weight: 600;
    }

    .btn-action {
        background: linear-gradient(135deg, var(--red-elite), #dc2626);
        color: white;
        padding: 9px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(185, 28, 28, 0.2);
    }

    .btn-action:hover {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(185, 28, 28, 0.3);
    }

    .status-text {
        color: #9ca3af;
        font-size: 14px;
        font-style: italic;
    }

    .btn-back {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
        padding: 12px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #4b5563, #374151);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(107, 114, 128, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: #9ca3af;
        font-style: italic;
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        color: #d1d5db;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .elite-card {
            padding: 20px;
        }

        .student-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .student-controls {
            width: 100%;
            justify-content: space-between;
        }

        .info-row {
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            min-width: auto;
        }
    }
</style>


    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Info Tugas -->
            <div class="elite-card" style="--delay: 1;">
                <h3 class="section-title">
                    📋 Informasi Tugas
                </h3>

                <div class="task-info-box">
                    <div class="info-row">
                        <span class="info-label">📚 Mata Pelajaran:</span>
                        <span class="info-value">{{ $tugas->mapel->nama_mapel }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">🏫 Kelas:</span>
                        <span class="info-value">{{ $tugas->kelas->nama_kelas }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">📅 Deadline:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($tugas->deadline)->translatedFormat('l, d F Y • H:i') }} WIB</span>
                    </div>

                    <div class="task-description">
                        <strong>📝 Deskripsi:</strong><br>
                        {{ $tugas->deskripsi }}
                    </div>

                    @if($tugas->file_tugas)
                        <div class="file-download-box">
                            <div class="file-info">
                                <div class="file-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="file-name">File Soal Tugas</div>
                                    <div class="text-xs text-gray-500">File yang diberikan ke siswa</div>
                                </div>
                            </div>
                            <a href="{{ route('tugas.download', $tugas) }}" class="btn-download-file">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>
                        </div>
                    @else
                        <p class="text-xs text-amber-700 mt-4 text-center italic">
                            Tidak ada file soal yang dilampirkan pada tugas ini
                        </p>
                    @endif
                </div>

                <!-- Statistik -->
                @php
                    $totalSiswa = $tugas->kelas->siswas->count();
                    $sudahKumpul = $tugas->pengumpulan->count();
                    $sudahDinilai = $tugas->pengumpulan->whereNotNull('nilai')->count();
                    $belumKumpul = $totalSiswa - $sudahKumpul;
                @endphp

                <div class="stats-bar">
                    <div class="stat-box">
                        <div class="stat-number">{{ $totalSiswa }}</div>
                        <div class="stat-label">Total Siswa</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number" style="color: #10b981;">{{ $sudahKumpul }}</div>
                        <div class="stat-label">Sudah Kumpul</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number" style="color: #f59e0b;">{{ $sudahDinilai }}</div>
                        <div class="stat-label">Sudah Dinilai</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number" style="color: #ef4444;">{{ $belumKumpul }}</div>
                        <div class="stat-label">Belum Kumpul</div>
                    </div>
                </div>
            </div>

            <!-- Daftar Siswa -->
            <div class="elite-card" style="--delay: 2;">
                <h3 class="section-title">
                    👥 Daftar Siswa
                </h3>

                @forelse($tugas->kelas->siswas as $siswa)
                    @php
                        $pengumpulan = $tugas->pengumpulan->where('siswa_id', $siswa->id)->first();
                    @endphp

                    <div class="student-card">
                        <div class="student-info">
                         <div class="student-avatar">
    @if ($siswa->foto_profile)
        <img src="{{ asset('storage/' . $siswa->foto_profile) }}" alt="Foto {{ $siswa->user->name }}">
    @else
        {{ strtoupper(substr($siswa->user->name, 0, 1)) }}
    @endif
</div>

                            <div class="student-details">
                                <span class="student-name">{{ $siswa->user->name }}</span>
                                <span class="student-nis">NISN: {{ $siswa->user->username }}</span>
                            </div>
                        </div>

                        <div class="student-controls">
                            <div class="score-badge 
                                {{ $pengumpulan 
                                    ? ($pengumpulan->nilai !== null ? 'graded' : 'submitted') 
                                    : 'missing' }}">
                                @if($pengumpulan && $pengumpulan->nilai !== null)
                                    ✓ {{ $pengumpulan->nilai }}/100
                                @elseif($pengumpulan)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg> Menunggu
                                @else
                                    Belum Kirim
                                @endif
                            </div>

                            @if($pengumpulan)
                                <a href="{{ route('pengumpulan.show', $pengumpulan->id) }}" class="btn-action">
                                    Lihat Detail
                                </a>
                            @else
                                <span class="status-text">–</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <p>Tidak ada siswa di kelas ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center elite-card" style="--delay: 3;">
                <a href="{{ route('tugas.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Tugas
                </a>
            </div>

        </div>
    </div>
</x-app-layout>