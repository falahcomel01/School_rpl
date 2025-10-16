<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Role') }}
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

        <form action="{{ route('roles.update', $roles->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Nama Role --}}
          <div class="mb-6">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Role</label>
            <input
              type="text"
              name="name"
              id="name"
              value="{{ old('name', $roles->name) }}"
              class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="contoh: admin, editor, kasir"
              required
            >
          </div>

          {{-- Header Permissions --}}
          <div class="mb-2 flex items-center justify-between">
            <label class="block text-gray-700 font-medium">Permissions</label>
            <div class="flex gap-2 text-sm">
              <button type="button" id="btn-select-all" class="px-3 py-1 border rounded">Pilih semua</button>
              <button type="button" id="btn-clear-all" class="px-3 py-1 border rounded">Bersihkan</button>
            </div>
          </div>

          {{-- Daftar Permissions (checkbox value = NAMA) --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 max-h-80 overflow-auto border rounded-lg p-3">
            @forelse ($permissions as $permission)
              <label class="flex items-center gap-2 text-gray-800">
                <input
                  type="checkbox"
                  id="permission-{{ $permission->id }}"
                  name="permission[]"
                  value="{{ $permission->name }}"
                  class="rounded border-gray-300"
                  @checked(collect(old('permission', $hasPermissions ?? []))->contains($permission->name))
                >
                <span class="text-sm">{{ $permission->name }}</span>
              </label>
            @empty
              <p class="text-sm text-gray-500">Belum ada permission.</p>
            @endforelse
          </div>

          {{-- Actions --}}
          <div class="flex justify-end mt-6 gap-2">
            <a href="{{ route('roles.index') }}"
              class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
              Batal
            </a>
            <button type="submit"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
              Update
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  {{-- helper kecil untuk select/clear --}}
  <script>
    document.getElementById('btn-select-all')?.addEventListener('click', () => {
      document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = true);
    });
    document.getElementById('btn-clear-all')?.addEventListener('click', () => {
      document.querySelectorAll('input[name="permission[]"]').forEach(cb => cb.checked = false);
    });
  </script>
</x-app-layout>