<x-app-layout>

    <div class="p-4 bg-white rounded shadow">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Tugas</th>
                    <th class="p-2 border">Mapel</th>
                    <th class="p-2 border">Guru</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumpulan as $i => $p)
                    <tr>
                        <td class="border p-2 text-center">{{ $i+1 }}</td>
                        <td class="border p-2">{{ $p->tugas->judul_tugas }}</td>
                        <td class="border p-2">{{ $p->tugas->mapel?->nama_mapel ?? '-' }}</td>
                        <td class="border p-2">{{ $p->tugas->guru?->user?->name ?? '-' }}</td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('pengumpulan.show', $p) }}" class="text-blue-600 underline">Detail</a> |
                            <a href="{{ route('pengumpulan.downloadFile', $p) }}" class="text-green-600 underline">Download</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-2 text-gray-500">Belum ada pengumpulan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pengumpulan->links() }}
        </div>
    </div>
</x-app-layout>
