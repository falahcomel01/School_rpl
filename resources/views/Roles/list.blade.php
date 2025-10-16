<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Role') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('roles.create') }}">
                            <x-primary-button>+ Tambah Role</x-primary-button>
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Create_At</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($roles as $role)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $role->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 font-medium">{{ $role->name }}</td>
                                    <td class="px-4 py-2">
                                        @if($role->permissions->count())
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($role->permissions as $perm)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                        {{ $perm->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        {{ optional($role->created_at)->format('Y-m-d H:i') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex gap-2 justify-end">
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                               class="px-3 py-1 text-xs rounded bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                                Edit
                                            </a>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin menghapus role ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1 text-xs rounded bg-red-100 text-red-700 hover:bg-red-200">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                                        Belum ada data role.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>