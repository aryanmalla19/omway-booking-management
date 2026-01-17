<x-guest-layout>
    <div class="flex justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="w-full max-w-6xl space-y-8">

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
