<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            @if(auth()->user()->role === 'admin')
            <!-- Notifikasi Lamaran Masuk untuk Admin -->
            <div class="mt-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 mb-4">Notifikasi Lamaran Masuk</h2>
                <div class="grid gap-4">
                    @forelse($notifications as $notif)
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 flex flex-col sm:flex-row sm:items-center justify-between border border-gray-200 dark:border-gray-700">
                            <div>
                                <div class="text-lg font-bold text-red-700 dark:text-red-300">{{ $notif->data['user_name'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">melamar <span class="font-semibold">{{ $notif->data['job_title'] }}</span></div>
                            </div>
                            <div class="mt-2 sm:mt-0 flex gap-2">
                                <a href="{{ url('storage/' . $notif->data['cv']) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors font-medium text-sm">Download CV</a>
                                <form method="POST" action="{{ route('notifications.dismiss', $notif->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors font-medium text-sm">X</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 dark:text-gray-400">Belum ada notifikasi lamaran masuk.</div>
                    @endforelse
                </div>
            </div>
            @endif
        </div>
    </div>

</x-app-layout>
