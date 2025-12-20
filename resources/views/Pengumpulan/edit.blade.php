<x-app-layout>
    <div class="p-4">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded p-4 mb-4">
            <h3 class="font-bold mb-2">Info Tugas</h3>
            <p><strong>Judul:</strong> {{ $pengumpulan->tugas?->judul_tugas ?? '-' }}</p>
            <p><strong>Mapel:</strong> {{ $pengumpulan->tugas?->mapel?->nama ?? '-' }}</p>
            <p><strong>Deadline:</strong> {{ $pengumpulan->tugas ? \Carbon\Carbon::parse($pengumpulan->tugas->deadline)->format('d-m-Y H:i') : '-' }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="font-bold mb-4">Form Revisi</h3>
            <form action="{{ route('pengumpulan.update', ['pengumpulan' => $pengumpulan]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium mb-1">File Baru (opsional)</label>
                    <input type="file" name="file_pengumpulan" 
                           class="border rounded w-full p-2 @error('file_pengumpulan') border-red-500 @enderror"
                           accept=".pdf,.doc,.docx,.ppt,.pptx,.zip">
                    <p class="text-xs text-gray-500 mt-1">
                        File saat ini: <strong>{{ $pengumpulan->file_pengumpulan ? basename($pengumpulan->file_pengumpulan) : 'Tidak ada file' }}</strong>
                    </p>
                    <p class="text-xs text-gray-500">Format: PDF, DOC, DOCX, PPT, PPTX, ZIP (Max: 10MB)</p>
                    @error('file_pengumpulan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Catatan</label>
                    <textarea name="catatan" 
                              class="border rounded w-full p-2 @error('catatan') border-red-500 @enderror" 
                              rows="4"
                              placeholder="Tulis catatan jika ada...">{{ old('catatan', $pengumpulan->catatan) }}</textarea>
                    @error('catatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('pengumpulan.show', ['pengumpulan' => $pengumpulan]) }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded inline-block">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
