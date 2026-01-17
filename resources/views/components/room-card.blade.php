@props(['room'])

<div class="bg-white dark:bg-[#161615] rounded-xl shadow overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <!-- Room Image -->
        <div class="md:col-span-1">
            <img src="{{ isset($room?->images->first()?->image_path) ? asset('storage/'.$room?->images->first()?->image_path) : 'https://picsum.photos/600/400' }}"
                 class="w-full h-full object-cover">
        </div>

        <div class="md:col-span-2 p-6 flex flex-col justify-between">

            <div class="space-y-3">
                <h2 class="text-2xl font-semibold dark:text-white">
                    {{ ucwords($room->room_type) }}
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ Str::limit($room->description, 200) }}
                </p>
                {{--                                <!-- Amenities -->--}}
                {{--                                <div class="flex flex-wrap gap-2 text-sm">--}}
                {{--                                    <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">Free Wi-Fi</span>--}}
                {{--                                    <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">AC</span>--}}
                {{--                                    <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">Breakfast</span>--}}
                {{--                                    <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">TV</span>--}}
                {{--                                </div>--}}
            </div>

            <!-- Price & Action -->
            <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <p class="text-sm text-gray-500">Price per night</p>
                    <p class="text-2xl font-semibold text-[#F53003]">
                        NPR {{ $room->price_per_day }}
                    </p>
                </div>

                <div class="flex gap-3">
                    <a
                        href="{{ route('bookings.room', $room) }}"
                        class="px-5 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                        Book Now
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
