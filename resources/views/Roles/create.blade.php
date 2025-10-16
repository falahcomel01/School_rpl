<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Role Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    {{-- Nama Role --}}
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-medium mb-2">
                            Nama Role
                        </label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="contoh: admin, editor, kasir" required>
                    </div>

                    {{-- Permission Picker --}}
                    <div class="mb-2 flex items-center justify-between gap-3">
                        <label class="block text-gray-700 font-medium">Permissions</label>
                        <div class="flex items-center gap-2">
                            <input id="selectAll" type="checkbox" class="rounded border-gray-300">
                            <label for="selectAll" class="text-sm text-gray-700">Pilih semua</label>
                        </div>
                    </div>

                    {{-- Grid Permission (tanpa pencarian) --}}
                    <div class="grid grid-cols-4 mb-3">
                    @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                            <div class="mt-3">
                            <input type="checkbox" id="permission-{{ $permission->id }}"
                            class="rounded" name="permission[]" value="{{
                            $permission->name}}">
                            <label for="permission-{{ $permission->id }}">{{
                            $permission->name }}</label>
                            </div>
                        @endforeach
                    @endif
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('roles.index') }}"
                           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-300 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script kecil: pilih semua --}}
    <script>
        const selectAll = document.getElementById('selectAll');
        const items = document.querySelectorAll('.permItem');
        selectAll?.addEventListener('change', e => {
            items.forEach(i => { i.checked = e.target.checked; });
        });
    </script>
</x-app-layout>