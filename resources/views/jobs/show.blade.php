<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                    <div class="flex items-start gap-6">
                        @if($job->logo)
                            <img src="{{ asset('storage/' . $job->logo) }}" alt="Logo" class="w-20 h-20 rounded" />
                        @else
                            <div class="w-20 h-20 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">No Logo</div>
                        @endif
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $job->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $job->company }} • {{ $job->location }}</p>
                            <div class="mt-2 flex items-center gap-3 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">{{ $job->job_type }}</span>
                                <span class="text-gray-600 dark:text-gray-400">{{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : 'Gaji tidak dicantumkan' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2">Deskripsi Pekerjaan</h4>
                        <p class="whitespace-pre-line leading-relaxed">{{ $job->description }}</p>
                    </div>

                    @auth
                        @if(Auth::user()->role !== 'admin')
                            <hr class="border-gray-200 dark:border-gray-700" />
                            <div>
                                <h4 class="font-semibold mb-3">Lamar Pekerjaan Ini</h4>
                                <form action="{{ route('apply.store', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4" onsubmit="return validateFileSize(this, {{ $job->id }})">
                                    @csrf
                                    <div class="flex items-center">
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
                                               
                                    <x-primary-button class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                        Lamar Sekarang
                                    </x-primary-button>
                                </form>
                            </div>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>

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
                    return false;
                }
            }
            return true;
        }
    </script>
</x-app-layout>
