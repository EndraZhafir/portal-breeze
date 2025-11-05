<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Lowongan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div>
                            <x-input-label for="title" :value="__('Judul Lowongan')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" placeholder="Contoh: Senior Web Developer" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea name="description" id="description" placeholder="Jelaskan tanggung jawab pekerjaan, kualifikasi, dll." class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" rows="5" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" placeholder="Contoh: Jakarta, Indonesia" :value="old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="company" :value="__('Nama Perusahaan')" />
                            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" placeholder="Contoh: PT. Teknologi Maju" :value="old('company')" required />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="salary" :value="__('Gaji (Opsional)')" />
                            <div class="flex rounded-md shadow-sm mt-1">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-sm">
                                    Rp
                                </span>
                                <x-text-input type="number" name="salary" id="salary" placeholder="10000000" class="block w-full !rounded-l-none" :value="old('salary')" />
                            </div>
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="logo" :value="__('Logo Perusahaan (Opsional)')" />
                            <input type="file" name="logo" id="logo" class="block w-full mt-1 text-sm text-gray-900 dark:text-gray-100
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0 file:text-sm file:font-semibold
                                file:bg-indigo-50 dark:file:bg-indigo-900 file:text-indigo-700 dark:file:text-indigo-300
                                hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800
                            ">
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Format file: jpg, png. Maks: 2MB.
                            </p>
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700"/>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Simpan Lowongan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>