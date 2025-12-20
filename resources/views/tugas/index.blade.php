<x-app-layout>

    <style>
        .page-wrapper {
            padding: 30px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-table {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #f1dada;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: 0.3s ease;
            margin-top: 20px;
        }
        .card-table:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.1);
        }
        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #b91c1c;
            border-bottom: 3px solid #b91c1c;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #fee2e2;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #f3c5c5;
            color: #7f1d1d;
            font-size: 14px;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #f3c5c5;
            font-size: 14px;
        }
        .btn-red {
            background-color: #dc2626;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            transition: 0.25s ease;
        }
        .btn-red:hover {
            background-color: #b91c1c;
        }
        .btn-outline {
            border: 1px solid #b91c1c;
            color: #b91c1c;
            padding: 7px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
        }
        .btn-outline:hover {
            background: #fbeaea;
        }
        .action-col {
            display: flex;
            gap: 8px;
        }
    </style>

    <div class="page-wrapper">
        <div class="max-w-6xl mx-auto">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(!Auth::user()->siswa)
                <a href="{{ route('tugas.create') }}" class="btn-red" style="display:inline-block; margin-bottom:15px;">
                    + Buat Tugas
                </a>
            @endif

            <div class="card-table">
                <div class="header-title">Daftar Tugas</div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Guru</th>
                            <th>Judul</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Deadline</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tugas as $i => $t)
                        <tr>
                            <td>{{ $tugas->firstItem() + $i }}</td>
                            <td>{{ $t->guru?->user?->name ?? '-' }}</td>
                            <td>{{ $t->judul_tugas }}</td>
                            <td>{{ $t->mapel?->nama_mapel ?? '-' }}</td>
                            <td>{{ $t->kelas?->nama_kelas ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->deadline)->format('d-m-Y H:i') }}</td>

                            <td>
                                <div class="action-col">

                                    @if(Auth::user()->siswa)
                                        @php
                                            $siswa_id = Auth::user()->siswa->id;
                                            $sudah = $t->pengumpulan->where('siswa_id', $siswa_id)->count();
                                        @endphp

                                        @if($sudah)
                                            <span class="text-gray-600">Sudah dikumpulkan</span>
                                        @else
                                            <a href="{{ route('pengumpulan.create.tugas', $t) }}"
                                               class="btn-red">Kerjakan</a>
                                        @endif

                                    @else
                                        <a href="{{ route('tugas.show', $t) }}" class="btn-outline">Detail</a>
                                        <a href="{{ route('tugas.edit', $t) }}" class="btn-outline">Edit</a>

                                        <form action="{{ route('tugas.destroy', $t) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus tugas ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn-red" style="border:none;">Hapus</button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4 text-gray-500">Tidak ada tugas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div style="margin-top:15px;">
                    {{ $tugas->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
