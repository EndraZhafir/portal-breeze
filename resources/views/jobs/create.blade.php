<x-app-layout>
    {{-- Slot untuk Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Lowongan') }}
        </h2>
    </x-slot>

    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- 
                      Kita batasi lebar form agar lebih rapi di layar besar.
                      'max-w-xl' bisa Anda ganti sesuai selera (mis: max-w-lg, max-w-2xl) 
                    --}}
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Judul Lowongan')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" placeholder="Mis: Senior Laravel Developer" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            {{-- Textarea tidak ada komponennya, jadi kita style manual --}}
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Jelaskan detail pekerjaan...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" placeholder="Mis: Jakarta, Indonesia" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Nama Perusahaan')" />
                            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" placeholder="Mis: PT. Teknologi Maju" />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="salary" :value="__('Gaji (Opsional)')" />
                            <x-text-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="old('salary')" placeholder="Mis: 10000000" />
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="logo" :value="__('Logo Perusahaan')" />
                            {{-- Input file juga kita style manual agar seragam --}}
                            <input id="logo" name="logo" type="file" class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>