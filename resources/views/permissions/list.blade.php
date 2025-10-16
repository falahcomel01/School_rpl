<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-50 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Toolbar: tombol create di kanan --}}
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('permissions.create') }}">
                            <x-primary-button>+ Tambah Permission</x-primary-button>
                        </a>
                    </div>

                    @if($permissions->count())
                        <div class="relative overflow-x-auto rounded-lg border border-gray-200">
                            <table class="w-full border-separate border-spacing-0 text-left text-sm text-gray-700">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="border border-gray-200 px-4 py-3 text-gray-500 text-xs uppercase">ID</th>
                                        <th class="border border-gray-200 px-4 py-3 text-gray-500 text-xs uppercase">Name</th>
                                        <th class="border border-gray-200 px-4 py-3 text-gray-500 text-xs uppercase">Created At</th>
                                        <th class="border border-gray-200 px-4 py-3 text-gray-500 text-xs uppercase text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                        <tr class="bg-white">
                                            <td class="border border-gray-200 px-4 py-3 font-mono text-gray-900">
                                                {{ $permission->id }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-3 font-medium text-gray-900">
                                                {{ $permission->name }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-3">
                                                {{ optional($permission->created_at)->format('d M Y H:i') }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-3">
                                                <div class="flex items-center justify-end gap-2">
                                                    {{-- EDIT --}}
                                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                                       class="inline-flex items-center rounded-md border border-indigo-200 bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700 hover:bg-indigo-100">
                                                        Edit
                                                    </a>

                                                    {{-- DELETE --}}
                                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center rounded-md border border-red-200 bg-red-50 px-3 py-1 text-xs font-medium text-red-700 hover:bg-red-100">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $permissions->links() }}
                        </div>
                    @else
                        <div class="rounded-lg border border-dashed p-10 text-center text-gray-500">
                            <p class="mb-3">Belum ada data permission.</p>
                            <a href="{{ route('permissions.create') }}">
                                <x-primary-button>+ Tambah Permission</x-primary-button>
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>