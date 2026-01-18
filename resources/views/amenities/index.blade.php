<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Amenity') }}
            </h2>
            <a class="rounded px-5 py-2 bg-blue-600 text-white" href="{{ route('amenities.create') }}">Add new Amenity</a>
        </div>
    </x-slot>

    <div class="p-12">
        <div class="overflow-x-auto">
            <table class="text-white min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-6 py-3 text-right text-sm font-medium">Actions</th>
                </tr>
                </thead>


                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($amenities as $amenity)
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>

                        <td class="px-6 py-4">{{ ucwords($amenity->name) }}</td>

                        <td class="px-6 py-4">
                            {{ $amenity->status ? 'Active' : 'In Active' }}
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
{{--                            <a href="{{ route('amenities.show', $amenity) }}"--}}
{{--                               class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 inline"--}}
{{--                            >--}}
{{--                                View--}}
{{--                            </a>--}}

                            <a href="{{ route('amenities.edit', $amenity) }}"
                               class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 inline"
                            >
                                Edit
                            </a>
                            <form action="{{ route('amenities.destroy', $amenity) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Are you sure?')"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No Amenities found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="p-4">
        {{ $amenities->links() }}
    </div>
</x-app-layout>
