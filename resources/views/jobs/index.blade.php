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
            <div class="flex justify-end mb-6">
                <a href="{{ route('jobs.create') }}">
                    <x-primary-button class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Tambah Lowongan') }}
                    </x-primary-button>
                </a>
            </div>

            {{-- Grid Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        {{-- Header Card dengan Logo --}}
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 relative">
                            @if ($job->logo)
                                <div class="absolute top-4 right-4 bg-white rounded-lg p-2 shadow-md">
                                    <img src="{{ asset('storage/' . $job->logo) }}" 
                                         class="w-16 h-16 object-contain" 
                                         alt="{{ $job->company }} logo">
                                </div>
                            @else
                                <div class="absolute top-4 right-4 bg-white rounded-lg p-2 shadow-md">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="pr-20">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $job->title }}</h3>
                                <p class="text-indigo-100 font-semibold">{{ $job->company }}</p>
                            </div>
                        </div>

                        {{-- Body Card --}}
                        <div class="p-6 space-y-4">
                            {{-- Lokasi --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 font-medium">{{ $job->location }}</p>
                                </div>
                            </div>

                            {{-- Jenis Pekerjaan --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Jenis Pekerjaan</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                                        {{ $job->jenis_pekerjaan ?? 'Full Time' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Gaji --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Gaji</p>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 font-semibold">
                                        {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : 'Negotiable' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('jobs.edit', $job->id) }}" 
                                   class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors font-medium text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="flex-1"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            @if($jobs->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Belum Ada Lowongan</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Mulai tambahkan lowongan pekerjaan pertama Anda</p>
                    <a href="{{ route('jobs.create') }}">
                        <x-primary-button>
                            Tambah Lowongan Pertama
                        </x-primary-button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>