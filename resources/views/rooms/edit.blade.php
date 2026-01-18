<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            {{ __('Edit Room') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

                <form method="POST" action="{{ route('rooms.update', $room) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Room Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium dark:text-gray-300 text-gray-700">
                            Room Type
                        </label>
                        <input
                            type="text"
                            name="room_type"
                            value="{{ old('room_type', $room?->room_type) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Deluxe, Single, Suite..."
                        >
                        @error('room_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Per Day -->
                    <div class="mb-4">
                        <label class="dark:text-gray-300 block text-sm font-medium text-gray-700">
                            Price Per Day (NPR)
                        </label>
                        <input
                            type="number"
                            name="price_per_day"
                            value="{{ old('price_per_day', $room?->price_per_day) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="1500"
                        >
                        @error('price_per_day')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Images -->
                    <div class="mb-6">
                        <label class="dark:text-gray-300 block text-sm font-medium text-gray-700">
                            Room Images
                        </label>
                        <input
                            type="file"
                            name="images[]"
                            multiple
                            class="mt-1 p-2 border rounded block w-full text-sm dark:text-gray-300 text-gray-600"
                        >
                        <p class="text-xs text-gray-500 mt-1">
                            You can upload multiple images (jpg, png, webp)
                        </p>

                        @error('images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        @error('images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($amenities->isNotEmpty())
                        <div class="mb-6">
                            <label class="block mb-3 text-sm font-medium text-gray-300">
                                Amenities
                            </label>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($amenities as $amenity)
                                    <label class="flex items-center gap-2 p-3 border rounded-lg cursor-pointer">
                                        <input
                                            type="checkbox"
                                            name="amenities[]"
                                            value="{{ $amenity->id }}"
                                            {{ in_array($amenity->id, $room->amenities->pluck('id')->toArray()) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                        >
                                        <span class="text-sm text-gray-300">
                                        {{ $amenity->name }}
                                    </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-6 flex flex-col">
                        <label class="text-gray-300" for="description">Description</label>
                        <textarea name="description" class="rounded-xl" id="description" rows="10">{{ old('description', $room->description) }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            Update Room
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
