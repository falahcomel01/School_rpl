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

        /* Animasi Global */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(15px); }
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

        /* Card Elite - PERBAIKAN: Hapus position relative yang menyebabkan tumpuk */
        .elite-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            overflow: hidden;
            box-shadow: 0 6px 25px -10px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0e6e0;
            opacity: 0;
            animation: fade-in-up 0.6s ease-out forwards;
            animation-delay: calc(var(--delay, 0) * 0.12s);
            transition: all 0.35s cubic-bezier(0.22, 0.61, 0.36, 1);
            margin-bottom: 24px; /* Jarak antar card yang konsisten */
            width: 100%; /* Pastikan lebar penuh */
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
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -12px rgba(0, 0, 0, 0.15);
            border-color: #e8dcd4;
        }

        /* Judul Serif Akademik */
        .task-title {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
            transition: color 0.3s ease;
        }

        .elite-card:hover .task-title {
            color: var(--red-elite);
        }

        /* Meta Info */
        .task-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 18px 0 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f3f1f0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14.5px;
            color: #555;
            transition: color 0.2s;
        }

        .meta-item i {
            color: var(--red-elite);
            font-size: 16px;
            min-width: 18px;
            text-align: center;
        }

        /* Badge Status */
        .status-badge {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
        }

        .badge {
            padding: 7px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14.5px;
            font-family: 'Segoe UI', sans-serif;
            border: 1px solid transparent;
            transition: all 0.35s cubic-bezier(0.22, 0.61, 0.36, 1);
            position: relative;
            overflow: hidden;
        }

        .badge::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .badge:hover::after {
            transform: translateX(100%);
        }

        .badge--graded {
            background: #f0fdf4;
            color: #065f46;
            border-color: #bbf7d0;
        }

        .badge--submitted {
            background: #fffbeb;
            color: #92400e;
            border-color: #fcd34d;
        }

        .badge--missing {
            background: #fef2f2;
            color: var(--red-elite);
            border-color: #fca5a5;
        }

        /* Tombol dengan Ripple Effect */
        .btn-action {
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15.5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 160px;
            font-family: 'Segoe UI', sans-serif;
            letter-spacing: 0.4px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn--primary {
            background: linear-gradient(135deg, var(--red-elite) 0%, #b91c1c 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(153, 27, 27, 0.25);
        }

        .btn--primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            transform: scale(0);
            transition: transform 0.5s ease;
            z-index: -1;
        }

        .btn--primary:hover::before {
            transform: scale(2);
        }

        .btn--primary:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(153, 27, 27, 0.35);
        }

        .btn--disabled {
            background: #f9fafb;
            color: #9ca3af;
            border: 1px solid #e5e7eb;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 18px;
            padding: 56px 32px;
            text-align: center;
            border: 1px solid #f0e6e0;
            color: #7e7e7e;
            font-style: italic;
            font-size: 1.1rem;
            box-shadow: 0 6px 20px -10px rgba(0, 0, 0, 0.06);
            opacity: 0;
            animation: fade-in-up 0.6s ease-out 0.2s forwards;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--gold-elite);
            opacity: 0.8;
            display: block;
        }

        /* Pagination */
        .pagination {
            margin-top: 36px;
            opacity: 0;
            animation: fade-in-up 0.6s ease-out 0.3s forwards;
        }

        /* Container untuk card */
        .cards-container {
            display: flex;
            flex-direction: column;
            gap: 0; /* Hapus gap, gunakan margin-bottom di card */
        }

        /* Responsif */
        @media (max-width: 768px) {
            .elite-card {
                padding: 22px;
                margin-bottom: 20px;
            }

            .task-title {
                font-size: 1.3rem;
            }

            .task-meta {
                gap: 14px;
                flex-direction: column;
            }

            .status-badge {
                margin-top: 14px;
                align-items: flex-start;
            }

            .btn-action {
                width: 100%;
                min-width: auto;
            }
        }
    </style>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="cards-container">
                @forelse ($tugas as $index => $t)
                    @php
                        $pengumpulan = $t->pengumpulan->where('siswa_id', auth()->user()->siswa->id)->first();
                        $isDeadlinePassed = now()->isAfter($t->deadline);
                    @endphp

                    <div class="elite-card" style="--delay: {{ $index + 1 }};"data-deadline="{{ $t->deadline }}">

                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
                            <div class="flex-1">
                                <h3 class="task-title">{{ $t->judul_tugas }}</h3>

                                <div class="task-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        <span class="font-medium">{{ $t->guru->user->name ?? '–' }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="far fa-calendar-check"></i>
                                        <span>{{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('l, d F Y • H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>

                            <div class="status-badge">
                                @if($pengumpulan)
                                    @if($pengumpulan->nilai !== null)
                                        <span class="badge badge--graded">Nilai: {{ $pengumpulan->nilai }}/100</span>
                                        <small class="text-xs font-medium text-emerald-700">Tugas telah dinilai</small>
                                    @else
                                        <span class="badge badge--submitted">Menunggu Penilaian</span>
                                        <small class="text-xs font-medium text-amber-700">Sudah dikumpulkan</small>
                                    @endif
                                @else
                                    <span class="badge badge--missing">Belum Dikumpulkan</span>
                                    @if($isDeadlinePassed)
                                        <small class="text-xs font-medium text-red-600">Deadline telah lewat</small>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 flex justify-center md:justify-end">
                            @if($pengumpulan)
                                <a href="{{ route('pengumpulan.show', $pengumpulan) }}" class="btn-action btn--primary">
                                    {{ $pengumpulan->nilai !== null ? 'Lihat Tugas (Dinilai)' : 'Lihat Tugas (Menunggu Nilai)' }}
                                </a>
                            @else
                                @if($isDeadlinePassed)
                                    <span class="btn-action btn--disabled">Tidak Dapat Dikumpulkan</span>
                                @else
                                    <a href="{{ route('pengumpulan.create.tugas', $t) }}" class="btn-action btn--primary">Kerjakan Sekarang</a>
                                @endif
                            @endif
                        </div>
                    </div>

                @empty
                    <div class="empty-state">
                        <i class="fas fa-graduation-cap"></i>
                        <p>Belum ada tugas akademik untuk mata pelajaran ini.</p>
                    </div>
                @endforelse
            </div>

            @if($tugas->hasPages())
                <div class="pagination">
                    {{ $tugas->links() }}
                </div>
            @endif
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".elite-card");

    function updateDeadlines() {
        cards.forEach(card => {
            const deadline = card.getAttribute("data-deadline");
            if (!deadline) return;

            const deadlineTime = new Date(deadline).getTime();
            const now = Date.now();

            const isLate = now > deadlineTime;

            const statusBadge = card.querySelector(".badge--missing");
            const infoText = card.querySelector(".status-badge small");
            const actionBtn = card.querySelector(".btn-action");

            // Hanya berlaku jika BELUM mengumpulkan
            if (statusBadge && actionBtn && !actionBtn.classList.contains("btn--disabled")) {
                if (isLate) {
                    // Ubah badge status
                    if (infoText) {
                        infoText.textContent = "Deadline telah lewat";
                        infoText.classList.add("text-red-600");
                    }

                    // Ubah tombol
                    actionBtn.textContent = "Tidak Dapat Dikumpulkan";
                    actionBtn.classList.remove("btn--primary");
                    actionBtn.classList.add("btn--disabled");
                    actionBtn.removeAttribute("href");
                }
            }
        });
    }

    // Jalankan setiap 1 detik
    setInterval(updateDeadlines, 1000);
});
</script>

</x-app-layout>