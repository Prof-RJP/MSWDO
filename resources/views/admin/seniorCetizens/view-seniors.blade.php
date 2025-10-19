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
                {{ __('Senior Cetizens') }}
            </h2>
            <a href="{{ route('admin.senior') }}"
                class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                <i class="fas fa-angle-left"></i>
                <span>Back</span>
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">
                    @foreach ($barangay as $brgy)
                        @if ($brgy_id == $brgy->id)
                            {{ $brgy->barangay }} SAN QUINTIN, PANGASINAN
                        @endif
                    @endforeach
                </h1>
                <p class="italic text-gray-500">Manage and update senior cetizens information.</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.view-senior', $brgy_id) }}"
                class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..."
                    class="border rounded-lg px-3 py-1 focus:ring focus:ring-green-200">
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded-lg">Search</button>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-collapse border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        @php
                            function sort_link($column, $label, $sort, $direction)
                            {
                                $newDir = $sort === $column && $direction === 'asc' ? 'desc' : 'asc';
                                $arrow = $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '';
                                return "<a href='?sort={$column}&direction={$newDir}' class='flex items-center'>{$label} {$arrow}</a>";
                            }
                        @endphp

                        <th class="px-4 py-3">{!! sort_link('osca_id', 'OSCA ID', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3">{!! sort_link('lname', 'Full Name', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3">{!! sort_link('age', 'Age', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3">{!! sort_link('status', 'Status', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3">{!! sort_link('action', 'Action', $sortField ?? '', $sortDirection ?? '') !!}</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($seniors as $sr)
                        <tr class="hover:bg-gray-200 cursor-pointer"
                            onclick="window.location='{{ route('senior.edit', ['id' => $sr->id, 'brgy_id' => $sr->brgy_id]) }}'">
                            <td class="px-4 py-3 uppercase">{{ $sr->osca_id }}</td>
                            <td class="px-4 py-3 uppercase">{{ $sr->full_name }}</td>
                            <td class="px-4 py-3 uppercase">{{ $sr->age }}</td>
                            <td class="px-4 py-3 uppercase">
                                @if ($sr->status == 'Active')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-sm font-semibold">
                                        {{ $sr->status }}
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-sm font-semibold">
                                        {{ $sr->status }}
                                    </span>
                                    
                                @endif
                            </td>
                            <td class="px-4 py-3 uppercase">
                                <form action="{{ route('senior.destroy', ['brgy_id' => $brgy_id, 'id' => $sr->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 px-2 py-1 rounded-md hover:bg-white hover:text-red-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6 shrink-0 text-white hover:text-red-600 transition">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9 3a1 1 0 0 0-1 1v1H4.5a.5.5 0 0 0 0 1H5v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h.5a.5.5 0 0 0 0-1H16V4a1 1 0 0 0-1-1H9Zm1 4a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-1.5 0V7.75A.75.75 0 0 1 10 7Zm4 0a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-1.5 0V7.75A.75.75 0 0 1 14 7Z" />
                                        </svg>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">No clients found</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $seniors->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
