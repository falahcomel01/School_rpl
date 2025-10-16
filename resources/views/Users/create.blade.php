<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tambah User') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('users.store') }}" method="POST">
          @csrf
          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
            @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
            @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Username</label>
            <input type="text" name="username" value="{{ old('username') }}"
                   class="w-full border-gray-300 rounded-md shadow-sm">
            @error('username')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Password</label>
            <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm">
            @error('password')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Role</label>
            <div class="flex flex-wrap gap-2">
              @foreach ($roles as $role)
                <label class="inline-flex items-center">
                  <input type="checkbox" name="roles[]" value="{{ $role->name }}">
                  <span class="ml-2">{{ $role->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="mt-6">
            <button type="submit" class="bg-blue-600  hover:bg-blue-700 hover:bg-blue-700font-semibold py-2 px-4 rounded">
              Simpan
            </button>
            <a href="{{ route('users.index') }}" class="ml-2 text-gray-600 hover:underline">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
