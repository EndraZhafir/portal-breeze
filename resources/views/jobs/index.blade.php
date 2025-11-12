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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Tambah Lowongan') }}
                    </x-primary-button>
                </a>
            </div>

            {{-- Grid Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        {{-- Header Card dengan Logo --}}
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 relative">
                            @if ($job->logo)
                                <div class="absolute top-4 right-4 bg-white rounded-lg p-2 shadow-md">
                                    <img src="{{ asset('storage/' . $job->logo) }}" class="w-16 h-16 object-contain"
                                        alt="{{ $job->company }} logo">
                                </div>
                            @else
                                <div class="absolute top-4 right-4 bg-white rounded-lg p-2 shadow-md">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
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
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 font-medium">{{ $job->location }}
                                    </p>
                                </div>
                            </div>

                            {{-- Jenis Pekerjaan --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Jenis Pekerjaan</p>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                                        {{ $job->jenis_pekerjaan ?? 'Full Time' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Gaji --}}
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>

                            <div>
                                <form action="{{ route('apply.store', $job->id) }}" method="POST"
                                    enctype="multipart/form-data"
                                    class="flex flex-col gap-3 justify-start items-center w-full max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                                    @csrf

                                    <label for="cv-{{ $job->id }}"
                                        class="w-full cursor-pointer flex flex-col items-center justify-center gap-3 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-6 hover:border-green-500 transition-all duration-300 bg-gray-50 dark:bg-gray-900/30 hover:bg-green-50 dark:hover:bg-green-900/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-500"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M224,44H32A12,12,0,0,0,20,56V192a20,20,0,0,0,20,20H216a20,20,0,0,0,20-20V56A12,12,0,0,0,224,44ZM193.15,68,128,127.72,62.85,68ZM44,188V83.28l75.89,69.57a12,12,0,0,0,16.22,0L212,83.28V188Z">
                                            </path>
                                        </svg>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 font-medium">
                                            Klik untuk unggah CV (PDF saja)
                                        </p>
                                        <input type="file" name="cv" id="cv-{{ $job->id }}"
                                            accept="application/pdf" required class="hidden"
                                            onchange="previewFile(event, {{ $job->id }})">
                                    </label>

                                    {{-- Preview file --}}
                                    <div id="file-preview-{{ $job->id }}"
                                        class="hidden w-full items-center justify-between mt-3 bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400"
                                                fill="currentColor" viewBox="0 0 256 256">
                                                <path
                                                    d="M200,164v8h12a12,12,0,0,1,0,24H200v12a12,12,0,0,1-24,0V152a12,12,0,0,1,12-12h32a12,12,0,0,1,0,24ZM92,172a32,32,0,0,1-32,32H56v4a12,12,0,0,1-24,0V152a12,12,0,0,1,12-12H60A32,32,0,0,1,92,172Zm-24,0a8,8,0,0,0-8-8H56v16h4A8,8,0,0,0,68,172Zm100,8a40,40,0,0,1-40,40H112a12,12,0,0,1-12-12V152a12,12,0,0,1,12-12h16A40,40,0,0,1,168,180Zm-24,0a16,16,0,0,0-16-16h-4v32h4A16,16,0,0,0,144,180ZM36,108V40A20,20,0,0,1,56,20h96a12,12,0,0,1,8.49,3.52l56,56A12,12,0,0,1,220,88v20a12,12,0,0,1-24,0v-4H148a12,12,0,0,1-12-12V44H60v64a12,12,0,0,1-24,0ZM160,57V80h23Z">
                                                </path>
                                            </svg>
                                            <span id="file-name-{{ $job->id }}"
                                                class="text-sm text-gray-800 dark:text-gray-100 font-medium"></span>
                                        </div>
                                        <button type="button" onclick="removeFile({{ $job->id }})"
                                            class="text-gray-400 hover:text-red-500 transition-colors text-xs font-medium">Hapus</button>
                                    </div>

                                    <button type="submit"
                                        class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            viewBox="0 0 256 256">
                                            <path
                                                d="M224,44H32A12,12,0,0,0,20,56V192a20,20,0,0,0,20,20H216a20,20,0,0,0,20-20V56A12,12,0,0,0,224,44ZM193.15,68,128,127.72,62.85,68ZM44,188V83.28l75.89,69.57a12,12,0,0,0,16.22,0L212,83.28V188Z">
                                            </path>
                                        </svg>
                                        Lamar Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            @if ($jobs->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Belum Ada Lowongan</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Mulai tambahkan lowongan pekerjaan pertama Anda
                    </p>
                    <a href="{{ route('jobs.create') }}">
                        <x-primary-button>
                            Tambah Lowongan Pertama
                        </x-primary-button>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function previewFile(event, jobId) {
            const fileInput = document.getElementById(`cv-${jobId}`);
            const previewBox = document.getElementById(`file-preview-${jobId}`);
            const fileNameText = document.getElementById(`file-name-${jobId}`);
            const file = event.target.files[0];

            if (file) {
                if (file.type !== "application/pdf") {
                    alert("Hanya file PDF yang diperbolehkan!");
                    fileInput.value = "";
                    return;
                }
                fileNameText.textContent = file.name;
                previewBox.classList.remove('hidden');
                previewBox.classList.add('flex');
            }
        }

        function removeFile(jobId) {
            const fileInput = document.getElementById(`cv-${jobId}`);
            const previewBox = document.getElementById(`file-preview-${jobId}`);
            const fileNameText = document.getElementById(`file-name-${jobId}`);

            fileInput.value = "";
            fileNameText.textContent = "";
            previewBox.classList.add('hidden');
            previewBox.classList.remove('flex');
        }
    </script>
</x-app-layout>
