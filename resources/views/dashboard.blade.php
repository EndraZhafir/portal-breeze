<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- TAMPILAN KHUSUS ADMIN -->
            @if (Auth::user()->role == 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <!-- Card Statistik -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-900 font-bold">Total Lowongan</div>
                        <div class="text-3xl text-blue-600">{{ $stats['total_jobs'] ?? 0 }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-900 font-bold">Total Pelamar</div>
                        <div class="text-3xl text-green-600">{{ $stats['total_applicants'] ?? 0 }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-900 font-bold">Total User</div>
                        <div class="text-3xl text-purple-600">{{ $stats['total_users'] ?? 0 }}</div>
                    </div>
                </div>

                <!-- Section Notifikasi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Notifikasi Terbaru</h3>
                        @if (isset($unreadNotifications) && $unreadNotifications->count() > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach ($unreadNotifications as $notification)
                                    <li class="py-4 flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $notification->data['user_name'] ?? 'User' }}
                                                melamar posisi
                                                <span
                                                    class="font-bold">{{ $notification->data['job_title'] ?? 'Pekerjaan' }}</span>
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                        <a href="{{ route('applications.index') }}"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm">Lihat</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Tidak ada notifikasi baru.</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- TAMPILAN UMUM / USER BIASA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    @if (Auth::user()->role != 'admin')
                        <br> Status: Anda telah melamar {{ $myApplicationsCount ?? 0 }} pekerjaan.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
