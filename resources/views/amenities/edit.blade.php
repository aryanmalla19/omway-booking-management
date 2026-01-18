<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            {{ __('Edit Amenity') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

                <form method="POST" action="{{ route('amenities.update', $amenity) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium dark:text-gray-300 text-gray-700">
                            Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $amenity->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="AC, King Bed, Fan..."
                        >
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Per Day -->
                    <div class="mb-4">
                        <label class="dark:text-gray-300 block text-sm font-medium text-gray-700">
                            Status
                        </label>
                        <select class="w-full" name="status">
                            <option value="1" {{ old('status', $amenity->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $amenity->status) == 0 ? 'selected' : '' }}>In Active</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            Update Amenity
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
