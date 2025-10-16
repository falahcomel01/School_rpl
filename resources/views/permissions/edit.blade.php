<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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

                <form action="{{ route('permissions.update', $permissions->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Info ringkas (opsional) --}}
                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">ID</label>
                            <input type="text" value="{{ $permissions->id }}"
                                   class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-700"
                                   readonly>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Created At</label>
                            <input type="text" value="{{ optional($permissions->created_at)->format('d M Y H:i') }}"
                                   class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 text-gray-700"
                                   readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">
                            Nama Permission
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $permissions->name) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="contoh: create-user"
                            required
                        >
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('permissions.index') }}"
                           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-300 transition">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>