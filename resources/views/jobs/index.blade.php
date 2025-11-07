<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-gray-100">

                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 mb-4 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Tambah Lowongan
                    </a>
                    
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-gray-500 dark:text-gray-200">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-center">Perusahaan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Lokasi</th>
                                    <th scope="col" class="px-6 py-3 text-center">Gaji</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jenis</th>
                                    <th scope="col" class="px-6 py-3 text-center">Logo</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-white-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $job->title }}
                                    </th>
                                    <td class="px-6 py-4 text-left">{{ Str::limit($job->description, 100) }}</td>
                                    <td class="px-6 py-4 text-center">{{ $job->company }}</td>
                                    <td class="px-6 py-4 text-center">{{ $job->location }}</td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $job->job_type }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($job->logo)
                                            <img src="{{ asset('storage/' . $job->logo) }}" width="80" class="rounded mx-auto">
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('jobs.edit', $job->id) }}" class="inline-flex items-center px-3 py-1 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white-900 uppercase tracking-widest hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-white-900 transition ease-in-out duration-150">
                                                Edit
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data lowongan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>