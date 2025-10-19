<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
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
                {{ __('Birthday Events') }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-700 text-white px-3 py-2 rounded-lg hover:bg-blue-800">
                <i class="fas fa-plus"></i> Add Event
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">Event Management</h1>
                <p class="italic text-gray-500">Manage and organize senior birthday events.</p>
            </div>

            <!-- 🔍 Search -->
            <form method="GET" action="{{ route('admin.events') }}" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..."
                    class="border rounded-lg px-3 py-1 focus:ring focus:ring-blue-200">
                <button type="submit" class="bg-blue-700 text-white px-3 py-1 rounded-lg hover:bg-blue-800">Search</button>
            </form>
        </div>

        <!-- 📅 Events Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        @php
                            function sort_link($column, $label, $sort, $direction) {
                                $newDir = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
                                $arrow = $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '';
                                return "<a href='?sort={$column}&direction={$newDir}' class='flex items-center'>{$label} {$arrow}</a>";
                            }
                        @endphp

                        <th class="px-4 py-3 text-left">{!! sort_link('title', 'Title', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('starts_at', 'Date', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($events as $event)
                        <tr class="hover:bg-gray-50 cursor-pointer">
                            <td class="px-4 py-3 uppercase">{{ $event->title }}</td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($event->starts_at)->format('F d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('claims.index', $event->id) }}"
                                    class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded-lg transition">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-500">No events found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $events->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
