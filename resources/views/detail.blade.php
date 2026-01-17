<x-guest-layout>
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <div class="w-full max-w-6xl space-y-8">

            <div>
                <h1 class="text-3xl font-semibold dark:text-white">Available Rooms</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Choose the perfect room for your stay
                </p>
            </div>

            <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white dark:bg-[#161615] rounded-xl shadow p-6 space-y-6">
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($room->images as $image)
                            <img src="{{ asset('storage/'.$image->image_path) }}" class="w-full" alt="random">
                        @endforeach
                    </div>

                    <div class="space-y-2">
                        <h1 class="text-2xl font-semibold dark:text-white">
                            {{ ucwords($room->room_type) }} Room
                        </h1>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $room->description }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3 text-sm">
                        <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">Free Wi-Fi</span>
                        <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">AC</span>
                        <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">Breakfast</span>
                        <span class="px-3 py-1 bg-gray-100 dark:bg-[#3E3E3A] rounded-full">Mountain View</span>
                    </div>

                </div>

                <div class="bg-white dark:bg-[#161615] rounded-xl shadow p-6 space-y-4 sticky top-6 h-fit">

                    <div>
                        <p class="text-sm text-gray-500">Price per night</p>
                        <p class="text-2xl font-semibold text-[#F53003]">
                            NPR {{ $room->price_per_day }}
                        </p>
                    </div>

                    <form class="space-y-4" action="{{ route('bookings.store', $room) }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div>
                            <label class="text-sm">Check-in</label>
                            <input type="date" name="check_in" value="{{ old('check_in') }}"
                                   class="w-full border rounded-md px-3 py-2 mt-1">
                            @error('check_in')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm">Check-out</label>
                            <input type="date" name="check_out" value="{{ old('check_out') }}"
                                   class="w-full border rounded-md px-3 py-2 mt-1">
                            @error('check_out')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between border-t pt-3 text-sm">
                            <span>Total (2 nights)</span>
                            <span class="font-semibold">NPR 13,000</span>
                        </div>

                        <!-- Button -->
                        <button type="submit"
                                class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
                            Book Now
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
