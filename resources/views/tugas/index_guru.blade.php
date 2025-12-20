<x-app-layout>


    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        .card-wrapper {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            border: 1px solid #e5d2d2;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
        }

        .title-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: #b91c1c;
        }

        .btn-add {
            background-color: #dc2626;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-add:hover {
            background-color: #b91c1c;
        }

        .task-card {
            border: 1px solid #f0bcbc;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .task-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .deadline-text {
            font-size: 13px;
            color: #444;
        }

        .task-bottom {
            display: flex;
            justify-content: flex-end;
            margin-top: 6px;
        }

        .btn-detail {
            background-color: #dc2626;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-detail:hover {
            background-color: #b91c1c;
        }

        .empty-msg {
            text-align: center;
            color: #777;
            font-style: italic;
            padding: 20px;
        }

        /* === Notifikasi Seragam === */
        .alert-success {
            background-color: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-error {
            background-color: #fee2e2;
            border-left: 4px solid #dc2626;
            color: #7f1d1d;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>

    <div class="py-10">
        <div class="container">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Notifikasi Error (Validasi, dll) --}}
            @if ($errors->any())
                <div class="alert-error">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-wrapper">
                <div class="title-box">
                    <div class="title-text">Daftar Tugas</div>

                    @if (!Auth::user()->siswa)
                        <a href="{{ route('tugas.create') }}" class="btn-add">+ Tambah Tugas</a>
                    @endif
                </div>

                <div class="mt-4">
                    @forelse ($tugas as $t)
                        <div class="task-card">
                            <div class="task-title">
                                {{ $t->judul_tugas }}
                            </div>
                            <div class="deadline-text">
                                Deadline:
                                {{ \Carbon\Carbon::parse($t->deadline)->translatedFormat('l, d F Y, H:i') }} WIB
                            </div>
                            <div class="task-bottom">
                                <a href="{{ route('tugas.show', $t) }}" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-msg">Tidak ada tugas.</div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $tugas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>