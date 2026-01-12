<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

                <div class="p-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        Booking List
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="text-white min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Room</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Booked By</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Days</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Booking Status</th>
                            <th class="px-6 py-3 text-right text-sm font-medium">Actions</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>

                                <td class="px-6 py-4">{{ ucwords($booking->room->room_type) }}</td>

                                <td class="px-6 py-4">{{ $booking->user->name }}</td>

                                <td class="px-6 py-4">
                                    Rs. {{ number_format($booking->total_price) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->total_days }} days
                                </td>

                                <td class="px-6 py-4">
                                    @if ($booking->status === 'approved')
                                        <span class="px-2 py-1 text-sm rounded bg-green-100 text-green-700">
                                        Approved
                                    </span>
                                    @elseif ($booking->status === 'rejected')
                                        <span class="px-2 py-1 text-sm rounded bg-red-100 text-red-700">
                                        Rejected
                                    </span>
                                    @else
                                        <span class="px-2 py-1 text-sm rounded bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">

                                    {{-- Approve --}}
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                Approve
                                            </button>
                                        </form>

                                        {{-- Reject --}}
                                        <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Reject
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Delete --}}
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Are you sure?')"
                                            class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No bookings found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
