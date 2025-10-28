<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif
        });
    </script>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Claims Events') }}
            </h2>
            <a href="{{ route('admin.view-senior',$barangay->id) }}"
               class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
               <i class="fas fa-angle-left"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">
                    {{ $senior->full_name }}
                </h1>
                <p class="italic text-gray-500">View Senior Cetizen claimed history.</p>
            </div>

            {{-- <!-- Search Form -->
            <form method="GET" action="{{ route('admin.view-senior', $brgy_id) }}"
                class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..."
                    class="border rounded-lg px-3 py-1 focus:ring focus:ring-green-200">
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded-lg">Search</button>
            </form> --}}
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-collapse border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Event</th>
                        <th class="px-4 py-3 text-left">Date Claimed</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Remarks</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($claims as $claim)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-3">
                                {{ $claim->event->title ?? '—' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($claim->claimed_at)->format('F d, Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $claim->status === 'claimed' ? 'bg-green-200 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                    {{ ucfirst($claim->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $claim->remark ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                No claims found for this senior.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $claims->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
