<x-app-layout>

    <div class="container mx-auto p-4">

        {{-- INFO TUGAS --}}
        <div class="bg-white p-4 rounded shadow mb-4">
            <h3 class="font-bold text-lg mb-2">Informasi Tugas</h3>
            <p><strong>Mapel:</strong> {{ $tugas->mapel?->nama ?? '-' }}</p>
            <p><strong>Kelas:</strong> {{ $tugas->kelas?->nama_kelas ?? '-' }}</p>
            <p><strong>Guru:</strong> {{ $tugas->guru?->user->name ?? '-' }}</p>
            <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($tugas->deadline)->format('d-m-Y H:i') }}</p>
            <p><strong>Deskripsi:</strong> {{ $tugas->deskripsi }}</p>
        </div>

        {{-- STATISTIK --}}
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="bg-blue-100 p-3 rounded shadow">
                <p class="font-bold text-lg">{{ $total_siswa }}</p>
                <p>Total Siswa</p>
            </div>

            <div class="bg-green-100 p-3 rounded shadow">
                <p class="font-bold text-lg">{{ $total_pengumpulan }}</p>
                <p>Sudah Mengumpulkan</p>
            </div>

            <div class="bg-red-100 p-3 rounded shadow">
                <p class="font-bold text-lg">{{ $belum_mengumpulkan }}</p>
                <p>Belum Mengumpulkan</p>
            </div>

            <div class="bg-yellow-100 p-3 rounded shadow">
                <p class="font-bold text-lg">{{ $sudah_dinilai }}</p>
                <p>Sudah Dinilai</p>
            </div>
        </div>

        {{-- TABEL --}}
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold text-lg mb-3">Daftar Pengumpulan</h3>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama Siswa</th>
                        <th class="p-2 border">Waktu Pengumpulan</th>
                        <th class="p-2 border">File</th>
                        <th class="p-2 border">Catatan Siswa</th>
                        <th class="p-2 border">Nilai</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengumpulan as $i => $p)
                        <tr>
                            <td class="p-2 border text-center">{{ $i + 1 }}</td>
                            <td class="p-2 border">{{ $p->siswa->user->name?? '-' }}</td>
                            <td class="p-2 border text-center">
                                {{ $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') : '-' }}
                            </td>
                            <td class="p-2 border text-center">
                                @if ($p->file_pengumpulan)
                                    <a href="{{ route('pengumpulan.downloadFile', ['pengumpulan' => $p]) }}"
                                       class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="p-2 border">
                                {{ $p->catatan ?? '-' }}
                            </td>

                            <td class="p-2 border text-center">
                                <form action="{{ route('pengumpulan.nilai', ['pengumpulan' => $p]) }}" method="POST" class="flex gap-2 justify-center items-center">
                                    @csrf
                                    <input type="number" name="nilai" value="{{ $p->nilai }}"
                                        class="border rounded p-1 w-20 text-center"
                                        min="0" max="100" placeholder="0-100">

                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 text-sm rounded">
                                        Simpan
                                    </button>
                                </form>
                            </td>

                            <td class="p-2 border text-center">
                                <a href="{{ route('pengumpulan.show', ['pengumpulan' => $p]) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm inline-block">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 border text-center text-gray-500">
                                Belum ada siswa yang mengumpulkan tugas ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('tugas.show', ['tugas' => $tugas]) }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded inline-block">
                    Kembali ke Detail Tugas
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
