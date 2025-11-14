<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(Auth::user()->role == 'admin')
                {{ __('Daftar Pelamar') }}
            @else
                {{ __('Lamaran Saya') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(Auth::user()->role == 'admin')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    
                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300">Kelola Daftar Pelamar & Lowongan</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200">Import Lowongan (.xlsx)</h3>
                            <form action="{{ route('jobs.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 w-full">
                                @csrf
                                <input type="file" name="file" required class="flex-1 text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-red-50 file:text-red-600 dark:file:bg-red-900/30 dark:file:text-red-400
                                    hover:file:bg-red-100 dark:hover:file:bg-red-900/50"/>
                                <x-primary-button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-300 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Import
                                </x-primary-button>
                            </form>
                            <div>
                                <a href="{{ route('jobs.import.template') }}">
                                    <x-primary-button class="flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-300 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                        Download Template Import
                                    </x-primary-button>
                                </a>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200">Export Pelamar (.xlsx)</h3>
                            <form action="{{ route('applications.export') }}" method="GET" class="flex items-center gap-3 w-full">
                                <select name="job_id" class="flex-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-red-500 dark:focus:border-red-600 focus:ring-red-500 dark:focus:ring-red-600 rounded-md shadow-sm text-sm">
                                    <option value="">Export Semua Lowongan</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->title }} ({{ $job->company }})</option>
                                    @endforeach
                                </select>
                                
                                <x-primary-button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-300 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Export
                                </x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($applications as $app)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-500 to-orange-600 p-6 relative">
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ 
                                    $app->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                    ($app->status === 'Accepted' ? 'bg-green-100 text-green-800' : 
                                    'bg-red-100 text-red-800') 
                                }}">
                                    {{ $app->status }}
                                </span>
                            </div>
                            <div class="pr-16">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $app->user->name }}</h3>
                                <p class="text-red-100 font-semibold">{{ $app->job->title }}</p>
                            </div>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex flex-col items-center text-center">
                                <svg class="w-12 h-12 text-red-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Curriculum Vitae</p>
                                <a href="{{ asset('storage/'. $app->cv) }}" target="_blank"
                                   class="inline-flex items-center gap-2 rounded-lg border border-transparent bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download CV
                                </a>
                            </div>
                            
                            @if(Auth::user()->role == 'admin')
                            <div class="grid grid-cols-2 gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Accepted">
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>

                        @if(Auth::user()->role == 'admin')
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Belum Ada Pelamar</h3>
                            <p class="text-gray-600 dark:text-gray-400">Saat ini belum ada pelamar yang mendaftar pada lowongan manapun.</p>
                        @else
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Anda Belum Melamar</h3>
                            <p class="text-gray-600 dark:text-gray-400">Riwayat lamaran Anda akan muncul di sini setelah Anda melamar pekerjaan.</p>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
