<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Tambah Permission Baru
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white shadow-md rounded-2xl p-8 border border-gray-200">

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-300 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('permissions.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Permission
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: edit-posts"
                            class="w-full sm:w-2/3 border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 rounded-xl shadow-sm px-3 py-2"
                            required
                        >
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('permissions.index') }}"
                        class="px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                            Batal
                        </a>

                        {{-- Tombol Simpan (kontras tinggi) --}}
                        <button type="submit"
                                class="px-5 py-2 text-sm font-medium rounded-lg bg-blue-600 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 transition">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
