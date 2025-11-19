<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Daftar Pelamar') }}
        </h2>

        <a href="{{ route('applications.export') }}"
            class="bg-blue-50 px-3 py-2 rounded-xl text-blue-900 shadow-xl hover:bg-indigo-600 hover:text-white transition-all duration-300 font-sans font-semibold">Export
            All</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-800">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    {{-- Header --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                        <div>
                            <p class="text-lg font-medium text-gray-700 dark:text-gray-300">
                                Kelola daftar pelamar yang tersedia.
                            </p>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">
                        <table
                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                        Nama Pelamar</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                        Lowongan</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                        CV</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                        Status</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($applications as $app)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $app->user->name }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $app->job->title }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank"
                                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-1 text-xs font-semibold text-white hover:bg-indigo-700 dark:hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                                                Lihat CV
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <span
                                                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium
                                                {{ $app->status === 'Pending'
                                                    ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300'
                                                    : ($app->status === 'Accepted'
                                                        ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300'
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300') }}">
                                                {{ $app->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <form action="{{ route('applications.update', $app->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Accepted">
                                                    <button type="submit"
                                                        class="inline-flex items-center rounded-md bg-green-600 px-3 py-1 text-xs font-semibold text-white hover:bg-green-700 dark:hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                                                        Terima
                                                    </button>
                                                </form>

                                                <form action="{{ route('applications.update', $app->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <button type="submit"
                                                        class="inline-flex items-center rounded-md bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700 dark:hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Belum ada pelamar yang daftar.
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
