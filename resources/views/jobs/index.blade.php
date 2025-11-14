<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @auth
                @if(Auth::user()->role == 'admin')
                    <div class="flex justify-end items-center gap-4 mb-6">
                        
                        <a href="{{ route('jobs.create') }}">
                            <x-primary-button class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg border-2 border-green-500 dark:border-green-600 hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors font-medium text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ __('Tambah Lowongan') }}
                            </x-primary-button>
                        </a>

                        <a href="{{ route('applications.index') }}">
                            <x-primary-button class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg border-2 border-red-500 dark:border-red-600 hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="red" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                {{ __('Lihat Pelamar') }}
                            </x-primary-button>
                        </a>
                        
                    </div>
                @else
                    <div class="flex justify-end items-center gap-4 mb-6">
                        <a href="{{ route('applications.index') }}">
                            <x-primary-button class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg border-2 border-red-500 dark:border-red-600 hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="red" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                {{ __('Riwayat Lamar') }}
                            </x-primary-button>
                        </a>
                    </div>
                @endif
            @endauth

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500 to-orange-600 p-6 relative">
                        @if ($job->logo)
                        <div class="absolute top-4 right-4 bg-white rounded-lg p-2 shadow-md">
                            <img src="{{ asset('storage/' . $job->logo) }}" class="w-16 h-16 object-contain" alt="{{ $job->company }} logo">
                        </div>
                        @else
                        <div class="absolute top-4 right-4 bg-white rounded-lg p-2 shadow-md">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        @endif

                        <div class="pr-20">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $job->title }}</h3>
                            <p class="text-red-100 font-semibold">{{ $job->company }}</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                                <p class="text-sm text-gray-900 dark:text-gray-100 font-medium">{{ $job->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Jenis Pekerjaan</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                    {{ $job->job_type ?? 'Full-time' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Gaji</p>
                                <p class="text-sm text-gray-900 dark:text-gray-100 font-semibold">
                                    {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : 'Negotiable' }}
                                </p>
                            </div>
                        </div>

                        @auth
                            @if(Auth::user()->role == 'admin')
                            <div class="grid grid-cols-2 gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="flex items-center justify-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors font-medium text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            
                            @else
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <form action="{{ route('apply.store', $job->id) }}" 
                                      method="POST" 
                                      enctype="multipart/form-data" 
                                      class="flex-1 flex flex-col" 
                                      onsubmit="return validateFileSize(this, {{ $job->id }})">
                                    @csrf

                                    <div class="mb-4">
                                        <div class="flex justify-between items-center w-full">
                                            <label for="cv-{{ $job->id }}" 
                                                   class="cursor-pointer inline-flex items-center px-4 py-2 bg-red-50 text-red-600 text-sm font-semibold rounded-full hover:bg-red-100 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 transition-colors">
                                                Choose File
                                            </label>
                                            <span id="file-name-{{ $job->id }}" 
                                                  class="text-sm text-gray-500 dark:text-gray-400 truncate text-right ml-3">
                                                No file chosen (.pdf only)
                                            </span>
                                        </div>
                                        
                                        <input type="file" 
                                               name="cv" 
                                               required
                                               class="hidden" 
                                               id="cv-{{ $job->id }}" 
                                               accept=".pdf"
                                               onchange="updateFileName(this, {{ $job->id }})">
                                        
                                        <span id="file-error-{{ $job->id }}" class="text-red-600 dark:text-red-400 text-xs mt-2 hidden"></span>
                                    </div>

                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-42.34-77.66a8,8,0,0,1-11.32,11.32L136,139.31V184a8,8,0,0,1-16,0V139.31l-10.34,10.35a8,8,0,0,1-11.32-11.32l24-24a8,8,0,0,1,11.32,0Z"></path>
                                        </svg>
                                        Lamar
                                    </button>
                                </form>
                            </div>
                            @endif
                        @endauth

                        <div class="mt-4">
                            <a href="{{ route('jobs.show', $job->id) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-300 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-900/50 transition-colors font-medium text-sm">
                                <svg class="w-4 h-4" fill="orange" viewBox="0 0 256 256"><path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-32-80a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,136Zm0,32a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,168Z"></path></svg>
                                Detail Lowongan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($jobs->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
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

<script>
    function updateFileName(input, id) {
        const fileNameSpan = document.getElementById('file-name-' + id);
        const fileErrorSpan = document.getElementById('file-error-' + id);
        
        if (input.files && input.files.length > 0) {
            fileNameSpan.textContent = input.files[0].name;
            fileErrorSpan.classList.add('hidden');
            fileErrorSpan.textContent = '';
        } else {
            fileNameSpan.textContent = 'No file chosen';
        }
    }

    function validateFileSize(form, id) {
        const input = document.getElementById('cv-' + id);
        const fileErrorSpan = document.getElementById('file-error-' + id);
        const maxSizeInBytes = 2048 * 1024; // 2MB

        fileErrorSpan.classList.add('hidden');
        fileErrorSpan.textContent = '';

        if (input.files && input.files.length > 0) {
            if (input.files[0].size > maxSizeInBytes) {
                fileErrorSpan.textContent = 'File terlalu besar! Ukuran maksimal 2MB.';
                fileErrorSpan.classList.remove('hidden');
                return false; // Mencegah form di-submit
            }
        }
        
        return true; // Lanjutkan submit form
    }
</script>
