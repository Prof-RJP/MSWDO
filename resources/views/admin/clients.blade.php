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
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('admin.add-client') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <i class="fas fa-plus"></i> Add Client
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">Client Page</h1>
                <p class="italic text-gray-500">Manage and update client information.</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.client') }}" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..."
                    class="border rounded-lg px-3 py-1 focus:ring focus:ring-green-200">
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded-lg">Search</button>
            </form>
        </div>

        <!-- Table -->
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

                        <th class="px-4 py-3 text-left">{!! sort_link('full_name', 'Full Name', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('address', 'Address', $sortField ?? '', $sortDirection ?? '') !!}</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($clients as $client)
                        <tr class="hover:bg-gray-50 cursor-pointer"
                            onclick="window.location='{{ route('client.edit', $client->id) }}'">
                            <td class="px-4 py-3 uppercase">{{ $client->full_name }}</td>
                            <td class="px-4 py-3 uppercase">
                                @foreach ($barangay as $brgy)
                                    @if ($brgy->id == $client->brgy_id)
                                        {{ $brgy->barangay }}
                                    @endif
                                    
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No clients found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $clients->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
