<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-gray-50 to-white shadow-sm rounded-2xl p-8 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                    Selamat datang kembali, {{ Auth::user()->name }} 👋
                </h3>
                <p class="text-gray-500">
                    Kamu sudah berhasil login sebagai <span class="font-medium text-indigo-600">({{ Auth::user()->roles->pluck('name')->implode(',')}})</span>.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

