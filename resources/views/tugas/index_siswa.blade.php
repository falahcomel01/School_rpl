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
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2.2s infinite;
        }

        /* Card Premium */
        .elite-card {
            background: white;
            border-radius: 18px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 25px -10px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0e6e0;
            margin-top: 12px;
        }

        .elite-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--red-elite), var(--gold-elite));
        }

        /* Daftar Mapel sebagai Card (bukan tabel kaku) */
        .mapel-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mapel-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 24px;
            border-radius: 14px;
            background: #faf9f8;
            border: 1px solid #f0e9e3;
            transition: all 0.3s cubic-bezier(0.22, 0.61, 0.36, 1);
            opacity: 0;
            animation: fade-in-up 0.6s ease-out forwards;
            animation-delay: calc(var(--delay, 0) * 0.1s);
        }

        .mapel-item:hover {
            background: #fdf6f6;
            border-color: #fbbfbf;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px -8px rgba(153, 27, 27, 0.1);
        }

        .mapel-info {
            flex: 1;
        }

        .mapel-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .mapel-stats {
            font-size: 14px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stat-item i {
            color: var(--red-elite);
            font-size: 14px;
        }

        .btn-view {
            background: linear-gradient(135deg, var(--red-elite), #b91c1c);
            color: white;
            padding: 10px 22px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14.5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(153, 27, 27, 0.2);
            white-space: nowrap;
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            transform: translateY(-2px);
            box-shadow: 0 5px 14px rgba(153, 27, 27, 0.28);
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: #7e7e7e;
            font-style: italic;
            font-size: 1.1rem;
            opacity: 0;
            animation: fade-in-up 0.6s ease-out 0.2s forwards;
        }

        .empty-state i {
            font-size: 2.8rem;
            color: var(--gold-elite);
            margin-bottom: 16px;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .mapel-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .mapel-actions {
                width: 100%;
                display: flex;
                justify-content: flex-end;
            }

            .btn-view {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="elite-card">
                @forelse($mapel as $i => $m)
                    <div class="mapel-item" style="--delay: {{ $i + 1 }};">
                        <div class="mapel-info">
                            <div class="mapel-name">{{ $m->nama_mapel }}</div>
                            <div class="mapel-stats">
                                <div class="stat-item">
                                    <i class="fas fa-tasks"></i>
                                    <span>{{ $m->tugas_count ?? 0 }} tugas</span>
                                </div>
                            </div>
                        </div>
                        <div class="mapel-actions">
                            <a href="{{ route('tugas.by.mapel', $m) }}" class="btn-view">
                                <i class="fas fa-eye"></i> Lihat Tugas
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-graduation-cap"></i>
                        <p>Belum ada mata pelajaran yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>