<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tombol Tambah Lowongan --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('jobs.create') }}">
                    {{-- Menggunakan komponen tombol utama dari Breeze --}}
                    <x-primary-button>
                        {{ __('Tambah Lowongan') }}
                    </x-primary-button>
                </a>
            </div>

            {{-- Container Tabel --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Padding di dalam container --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Wrapper untuk overflow responsif --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            {{-- Header Tabel --}}
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Judul
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Perusahaan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Gaji
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Logo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            {{-- Body Tabel --}}
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                        {{-- Judul (dibuat font tebal) --}}
                                        <th scope="row"
                                            class="px-6 py-4 font-medium">
                                            {{ $job->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $job->company }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $job->location }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Format gaji jika ada --}}
                                            {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($job->logo)
                                                {{-- Styling gambar --}}
                                                <img src="{{ asset('storage/' . $job->logo) }}"
                                                    class="w-20 h-20 object-cover rounded-md"
                                                    alt="{{ $job->company }} logo">
                                            @else
                                                <span class="text-gray-400 text-xs">Tidak ada logo</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- Styling tombol aksi --}}
                                            <div class="flex space-x-4 gap-2">
                                                <a href="{{ route('jobs.edit', $job->id) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 bg-white rounded-lg px-3 py-2 hover:underline">Edit</a>

                                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="font-medium text-white dark:text-white bg-red-500 rounded-lg px-3 py-2 hover:underline">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
