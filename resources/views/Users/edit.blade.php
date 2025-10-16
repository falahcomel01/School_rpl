<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
      <a href="{{ route('users.index') }}"
         class="px-3 py-2 text-sm border rounded-lg hover:bg-gray-50">
        Kembali
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">

        {{-- Alert sukses --}}
        @if(session('berhasil'))
          <div class="mb-4 bg-green-50 border border-green-200 text-green-800 p-3 rounded">
            {{ session('berhasil') }}
          </div>
        @endif

        {{-- Alert error --}}
        @if ($errors->any())
          <div class="mb-4 bg-red-50 border border-red-200 text-red-800 p-3 rounded">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
          @csrf
          @method('PUT')

          {{-- Nama --}}
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $user->name) }}"
                   class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          {{-- Username --}}
          <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username"
                   value="{{ old('username', $user->username) }}"
                   class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
            @error('username') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          {{-- Email --}}
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>

          {{-- Role --}}
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <div class="space-y-1">
              @foreach ($roles as $role)
                <label class="flex items-center space-x-2">
                  <input type="checkbox" name="role[]" value="{{ $role->name }}"
                    {{ in_array($role->id, $hasRole) ? 'checked' : '' }}>
                  <span>{{ $role->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          {{-- Tombol --}}
          <div class="flex justify-end gap-2">
            <a href="{{ route('users.index') }}"
               class="px-4 py-2 border rounded-lg hover:bg-gray-50">
              Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 border rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
              Simpan
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>
