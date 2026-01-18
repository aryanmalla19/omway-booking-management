@php use App\Enums\RoomStatus; @endphp
<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Rooms') }}
            </h2>
            <a class="rounded px-5 py-2 bg-blue-600 text-white" href="{{ route('rooms.create') }}">Add new Room</a>
        </div>
    </x-slot>

    <div class="p-12">
        <div class="overflow-x-auto">
            <table class="text-white min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Room Type</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Price Per Day</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Images</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-6 py-3 text-right text-sm font-medium">Actions</th>
                </tr>
                </thead>


                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($rooms as $room)
                        <tr>
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4">{{ ucwords($room->room_type) }} Room</td>

                            <td class="px-6 py-4">
                                Rs. {{ number_format($room->price_per_day) }}
                            </td>

                            <td class="px-6 py-4 flex gap-1">
                                @forelse($room->images()->limit(3)->get() as $image)
                                    <img class="w-6 h-6" src="{{ asset('storage/'.$image->image_path) }}" alt="Image">
                                @empty
                                    N/A
                                @endforelse
                            </td>

                            <td class="px-6 py-4">
                                @if ($room->status === RoomStatus::AVAILABLE)
                                    <span class="px-2 py-1 text-sm rounded bg-green-100 text-green-700">
                                        {{ RoomStatus::AVAILABLE->name }}
                                    </span>
                                @elseif ($room->status === RoomStatus::BOOKED)
                                    <span class="px-2 py-1 text-sm rounded bg-red-100 text-red-700">
                                        {{ RoomStatus::BOOKED->name }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right space-x-2">
{{--                                <a href="{{ route('rooms.show', $room) }}"--}}
{{--                                   class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 inline"--}}
{{--                                >--}}
{{--                                    View--}}
{{--                                </a>--}}

                                <a href="{{ route('rooms.edit', $room) }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 inline"
                                >
                                    Edit
                                </a>
                                <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline">
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
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="p-4">
        {{ $rooms->links() }}
    </div>
</x-app-layout>
