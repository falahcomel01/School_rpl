<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar User</h2>
      @can('create users')
      <a href="{{ route('users.create') }}"
         class="px-3 py-2 text-sm border rounded-lg hover:bg-gray-50">
        Tambah Akun pengguna
      </a>
      @endcan
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">

        {{-- Alert sukses --}}
        @if(session('berhasil'))
          <div class="mb-4 bg-green-50 border border-green-200 text-green-800 p-3 rounded">
            {{ session('berhasil') }}
          </div>
        @endif

        {{-- Alert error --}}
        @if(session('error'))
          <div class="mb-4 bg-red-50 border border-red-200 text-red-800 p-3 rounded">
            {{ session('error') }}
          </div>
        @endif

        <div class="overflow-x-auto">
          <table class="min-w-full border text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase">
              <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Username</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Role</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $index => $user)
                <tr class="border-b hover:bg-gray-50">
                  <td class="px-4 py-2 border">{{ $users->firstItem() + $index }}</td>
                  <td class="px-4 py-2 border">{{ $user->name }}</td>
                  <td class="px-4 py-2 border">{{ $user->username }}</td>
                  <td class="px-4 py-2 border">{{ $user->email }}</td>

                  {{-- Kolom Role --}}
                  <td class="px-4 py-2 border">
                    @forelse ($user->roles as $role)
                      <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded mr-1">
                        {{ $role->name }}
                      </span>
                    @empty
                      <span class="text-gray-400 text-xs italic">Tidak ada role</span>
                    @endforelse
                  </td>

                  {{-- Tombol aksi --}}
                  <td class="px-4 py-2 border text-center">
                    <div class="flex justify-center gap-2">
                      @can('edit users')
                      <a href="{{ route('users.edit', $user->id) }}"
                         class="px-2 py-1 text-xs border rounded hover:bg-gray-50">
                        Edit
                      </a>
                      @endcan
                      @can('delete users')
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-2 py-1 text-xs text-red-600 border border-red-300 rounded hover:bg-red-50">
                          Hapus
                        </button>
                      </form>
                      @endcan
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4 text-gray-500">
                    Belum ada data user.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
          {{ $users->links() }}
        </div>

      </div>
    </div>
  </div>
</x-app-layout>


