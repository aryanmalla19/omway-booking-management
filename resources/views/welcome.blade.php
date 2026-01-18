<x-guest-layout>
    <div class="flex justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="w-full max-w-6xl space-y-8">
            @auth
                <a
                    href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard')}}"
                    class="absolute right-10 bg-teal-500 px-5 py-2 text-white rounded"
                >
                    Dashboard
                </a>
            @else
                <div class="flex justify-end gap-x-5">
                    <a href="{{ route('login') }}" class="bg-teal-500 px-5 py-2 text-white rounded">Login</a>
                    <a href="{{ route('register') }}" class="bg-teal-500 px-5 py-2 text-white rounded">Register</a>
                </div>
            @endauth
                <div>
                <h1 class="text-3xl font-semibold dark:text-white">Available Rooms</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Choose the perfect room for your stay
                </p>
            </div>

            @forelse($rooms as $room)
                <x-room-card :room="$room" />
            @empty
                <p class="text-white/70">No Rooms Available Right Now</p>
            @endforelse
        </div>
    </div>
</x-guest-layout>
