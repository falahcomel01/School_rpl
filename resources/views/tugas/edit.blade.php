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

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tugas.update', ['tugas' => $tugas]) }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-4 rounded shadow max-w-xl">
            @csrf @method('PUT')

            <div>
                <label class="block font-medium mb-1">Mapel <span class="text-red-500">*</span></label>
                <select name="mapel_id" class="w-full border rounded p-2 @error('mapel_id') border-red-500 @enderror" required>
                    @foreach ($mapels as $m)
                        <option value="{{ $m->id }}" {{ (old('mapel_id', $tugas->mapel_id) == $m->id) ? 'selected' : '' }}>
                            {{ $m->nama }}
                        </option>
                    @endforeach
                </select>
                @error('mapel_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label class="block font-medium mb-1">Kelas <span class="text-red-500">*</span></label>
                <select name="kelas_id" class="w-full border rounded p-2 @error('kelas_id') border-red-500 @enderror" required>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ (old('kelas_id', $tugas->kelas_id) == $k->id) ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label class="block font-medium mb-1">Judul Tugas <span class="text-red-500">*</span></label>
                <input type="text" name="judul_tugas" value="{{ old('judul_tugas', $tugas->judul_tugas) }}" 
                       class="w-full border rounded p-2 @error('judul_tugas') border-red-500 @enderror" 
                       placeholder="Masukkan judul tugas" required>
                @error('judul_tugas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label class="block font-medium mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="4" 
                          class="w-full border rounded p-2 @error('deskripsi') border-red-500 @enderror" 
                          placeholder="Masukkan deskripsi tugas" required>{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label class="block font-medium mb-1">File Baru (opsional)</label>
                <input type="file" name="file_tugas" 
                       class="w-full border rounded p-2 @error('file_tugas') border-red-500 @enderror"
                       accept=".pdf,.doc,.docx,.ppt,.pptx,.zip">
                @if ($tugas->file_tugas)
                    <p class="text-sm mt-1 text-gray-600">
                        File saat ini:
                        <a href="{{ route('tugas.download', ['tugas' => $tugas]) }}" class="text-blue-600 underline">Download</a>
                    </p>
                @endif
                <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX, PPT, PPTX, ZIP (Max: 10MB)</p>
                @error('file_tugas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label class="block font-medium mb-1">Deadline <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="deadline"
                       value="{{ old('deadline', \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i')) }}"
                       class="w-full border rounded p-2 @error('deadline') border-red-500 @enderror" required>
                @error('deadline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 mt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Update
                </button>
                <a href="{{ route('tugas.show', ['tugas' => $tugas]) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded inline-block">
                    Batal
                </a>
            </div>
        </form>

    </div>
</x-app-layout>
