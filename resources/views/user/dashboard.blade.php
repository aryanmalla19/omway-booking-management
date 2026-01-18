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
                        My Booking History
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="text-white min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Room</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Check In & Out</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Total Days</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Booking Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Booking At</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Total Payable</th>
{{--                            <th class="px-6 py-3 text-center text-sm font-medium">Actions</th>--}}
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>

                                <td class="px-6 py-4">{{ ucwords($booking?->room?->room_type) }}</td>

                                <td class="px-6 py-4">
                                    Rs. {{ number_format($booking->total_price) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->check_in->format('d M, Y') }} to
                                    {{ $booking->check_out->format('d M, Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->total_days }} days
                                </td>

                                <td class="px-6 py-4">
                                    @if ($booking->status === \App\Enums\BookingStatus::APPROVED)
                                        <span class="px-2 py-1 text-sm rounded bg-green-100 text-green-700">
                                        Approved
                                    </span>
                                    @elseif ($booking->status === \App\Enums\BookingStatus::REJECTED)
                                        <span class="px-2 py-1 text-sm rounded bg-red-100 text-red-700">
                                        Rejected
                                    </span>
                                    @else
                                        <span class="px-2 py-1 text-sm rounded bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    {{ $booking->created_at->format('d M, Y - g:i A') }}
                                </td>

                                <td class="px-6 py-4">
                                    Rs. {{ $booking->total_payable_amount }}
                                </td>

{{--                                <td class="px-6 py-4 text-right space-x-2">--}}
{{--                                    <a href="#" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">--}}
{{--                                        Show Detail--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
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
