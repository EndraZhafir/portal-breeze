<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Lowongan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl flex flex-row gap-4 mx-auto sm:px-6 lg:px-8">
            <div class="max-w-3xl w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-8 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- TITLE --}}
                        <div class="space-y-2">
                            <x-input-label for="title" :value="__('Judul Lowongan')" class="text-base font-semibold" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <x-text-input id="title" class="block w-full pl-10 py-3" type="text"
                                    name="title" placeholder="Contoh: Senior Web Developer" :value="old('title')" required
                                    autofocus />
                            </div>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="space-y-2">
                            <x-input-label for="description" :value="__('Deskripsi')" class="text-base font-semibold" />
                            <textarea name="description" id="description"
                                placeholder="Jelaskan tanggung jawab pekerjaan, kualifikasi, benefit, dll."
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm block w-full py-3"
                                rows="6" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- COMPANY --}}
                        <div class="space-y-2">
                            <x-input-label for="company" :value="__('Nama Perusahaan')" class="text-base font-semibold" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <x-text-input id="company" class="block w-full pl-10 py-3" type="text"
                                    name="company" placeholder="Contoh: PT. Teknologi Maju" :value="old('company')"
                                    required />
                            </div>
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>

                        {{-- LOCATION & JENIS PEKERJAAN (Row) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- LOCATION --}}
                            <div class="space-y-2">
                                <x-input-label for="location" :value="__('Lokasi')" class="text-base font-semibold" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="location" class="block w-full pl-10 py-3" type="text"
                                        name="location" placeholder="Jakarta, Indonesia" :value="old('location')" required />
                                </div>
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>

                            {{-- JENIS PEKERJAAN --}}
                            <div class="space-y-2">
                                <x-input-label for="jenis_pekerjaan" :value="__('Jenis Pekerjaan')"
                                    class="text-base font-semibold" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <select name="jenis_pekerjaan" id="jenis_pekerjaan"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm block w-full pl-10 py-3"
                                        required>
                                        <option value="">Pilih Jenis Pekerjaan</option>
                                        <option value="Full-time"
                                            {{ old('jenis_pekerjaan') == 'Full-time' ? 'selected' : '' }}>Full Time
                                        </option>
                                        <option value="Part-time"
                                            {{ old('jenis_pekerjaan') == 'Part-time' ? 'selected' : '' }}>Part Time
                                        </option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('jenis_pekerjaan')" class="mt-2" />
                            </div>
                        </div>

                        {{-- SALARY --}}
                        <div class="space-y-2">
                            <x-input-label for="salary" :value="__('Gaji (Opsional)')" class="text-base font-semibold" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex rounded-lg shadow-sm">
                                    <span
                                        class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-semibold">
                                        Rp
                                    </span>
                                    <input type="number" name="salary" id="salary" placeholder="10000000"
                                        value="{{ old('salary') }}"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-r-lg shadow-sm block w-full py-3 pl-4">
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kosongkan jika gaji bisa dinegosiasi
                            </p>
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>

                        {{-- LOGO WITH PREVIEW --}}
                        <div class="space-y-2">
                            <x-input-label for="logo" :value="__('Logo Perusahaan (Opsional)')" class="text-base font-semibold" />

                            {{-- Preview Container --}}
                            <div id="logo-preview-container" class="hidden mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview Logo:</p>
                                <div class="relative inline-block">
                                    <img id="logo-preview"
                                        class="h-32 w-32 object-cover rounded-lg border-2 border-gray-300 dark:border-gray-600 shadow-md"
                                        alt="Logo Preview">
                                    <button type="button" onclick="clearLogoPreview()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- File Input --}}
                            <div class="flex items-center justify-center w-full">
                                <label for="logo"
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (MAX. 2MB)</p>
                                    </div>
                                    <input type="file" name="logo" id="logo" class="hidden"
                                        accept="image/*" onchange="previewLogo(event)">
                                </label>
                            </div>

                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700" />

                        {{-- SUBMIT BUTTON --}}
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('jobs.index') }}"
                                class="px-6 py-3 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Simpan Lowongan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div
                class="flex flex-col gap-4 justify-start items-center w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl py-20 px-8">
                {{-- Import Form --}}
                <form action="/jobs/import" method="POST" enctype="multipart/form-data"
                    class="flex flex-col items-center justify-center gap-4 w-full">
                    @csrf
                    <label for="file"
                        class="w-full cursor-pointer flex flex-row items-center justify-center gap-3 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-6 hover:border-indigo-500 transition-all duration-300 bg-white dark:bg-gray-900/30 hover:bg-indigo-50 dark:hover:bg-indigo-900/30">
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium text-center">
                            Unggah file Excel (.xlsx / .csv)
                        </p>
                        <input type="file" name="file" id="file" accept=".xlsx,.csv" required
                            class="hidden">
                    </label>

                    <button type="submit"
                        class="w-fit flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-500 transition-colors font-medium text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Import
                    </button>
                </form>

                {{-- Preview Container --}}
                <div id="preview-container"
                    class="w-full mt-8 hidden flex-col items-center text-sm text-gray-700 dark:text-gray-300 transition-all duration-500">
                    <h3 class="font-semibold text-lg mb-3 text-indigo-600 dark:text-indigo-400">Preview Data</h3>
                    <div id="preview"
                        class="w-full overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-900 p-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script>
        function previewLogo(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logo-preview').src = e.target.result;
                    document.getElementById('logo-preview-container').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function clearLogoPreview() {
            document.getElementById('logo').value = '';
            document.getElementById('logo-preview-container').classList.add('hidden');
            document.getElementById('logo-preview').src = '';
        }

        {{-- SheetJS Library --}}

        document.getElementById('file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview');
            const wrapper = document.getElementById('preview-container');

            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {
                    type: 'array'
                });
                const sheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[sheetName];
                const json = XLSX.utils.sheet_to_json(worksheet, {
                    header: 1
                });

                if (json.length === 0) {
                    previewContainer.innerHTML =
                        `<p class="text-center text-gray-500 italic">File kosong atau tidak valid.</p>`;
                    return;
                }

                // Bangun tabel
                let html = `
            <table class="min-w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">
                    ${json[0].map(cell => `<th class="border-b border-gray-200 dark:border-gray-700 px-3 py-2 font-semibold">${cell ?? ''}</th>`).join('')}
                </tr>
            </thead>
            <tbody>
             `;

                json.slice(1, 6).forEach((row, rowIndex) => {
                    html += `
                <tr class="${rowIndex % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-850'}">
                    ${row.map(cell => `<td class="border-b border-gray-200 dark:border-gray-700 px-3 py-2">${cell ?? ''}</td>`).join('')}
                </tr>
            `;
                });

                html += `
            </tbody>
            </table>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 italic">
                Menampilkan 5 baris pertama dari sheet
            </p>
        `;

                // Tampilkan hasil
                previewContainer.innerHTML = html;
                wrapper.classList.remove('hidden');
                wrapper.classList.add('flex');
            };

            reader.readAsArrayBuffer(file);
        });
    </script>
</x-app-layout>
