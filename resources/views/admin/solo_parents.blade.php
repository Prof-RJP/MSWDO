<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 500,
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
                {{ __('Solo Parents') }}
            </h2>
            <a href="{{ route('soloParents.create') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <i class="fas fa-plus"></i> Add Parent
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">Solo Parent Page</h1>
                <p class="italic text-gray-500">Manage and update solo parents information.</p>
            </div>

            <form method="GET" action="{{ route('admin.soloParents') }}" class="flex items-center space-x-2">
                <select name="barangay" class="border rounded-lg px-3 py-1 focus:ring focus:ring-green-200">
                    <option value="">All Barangays</option>
                    @foreach ($barangays as $b)
                        <option value="{{ $b->id }}" {{ request('barangay') == $b->id ? 'selected' : '' }}>
                            {{ strtoupper($b->barangay) }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search client..."
                    class="border rounded-lg px-3 py-1 focus:ring focus:ring-green-200">
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded-lg">Search</button>

                <a href="{{ route('soloParents.print', [
                    'barangay' => request('barangay'),
                    'search' => request('search'),
                ]) }}"
                    target="_blank"
                    class="bg-blue-700 text-white px-3 py-1 rounded-lg hover:bg-blue-800 flex items-center space-x-1">
                    <i class="fas fa-print"></i>
                    <span>Print</span>
                </a>

            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        @php
                            function sort_link($column, $label, $sort, $direction)
                            {
                                $newDir = $sort === $column && $direction === 'asc' ? 'desc' : 'asc';
                                $arrow = $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '';
                                return "<a href='?sort={$column}&direction={$newDir}' class='flex items-center font-bold'>{$label} {$arrow}</a>";
                            }
                        @endphp

                        <th class="px-4 py-3 text-left">{!! sort_link('id_no', 'ID No.', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('full_name', 'Full Name', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('barangay', 'Barangay', $sortField ?? '', $sortDirection ?? '') !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('solo_status', 'Status', $sortField ?? '', $sortDirection ?? '') !!}</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($clients as $sp)
                        <tr class="hover:bg-gray-50 cursor-pointer"
                            onclick="window.location='{{ route('soloParents.edit', $sp->id) }}'">
                            <td class="px-4 py-3 uppercase"> {{ $sp->id_no }} </td>
                            <td class="px-4 py-3 uppercase">{{ $sp->client->lname }}, {{ $sp->client->fname }}
                                {{ $sp->client->mname }}</td>
                            <td class="px-4 py-3 uppercase">{{ $sp->client->barangays->barangay ?? 'N/A' }}</td>

                            @if ($sp->solo_status == 'new')
                                <td
                                    class="px-4 py-3 uppercase text-center font-bold bg-green-400 text-green-900 rounded-lg">
                                    <span class="">{{ $sp->solo_status }}</span>
                                </td>
                            @elseif ($sp->solo_status == 'renew')
                                <td
                                    class="px-4 py-3 uppercase text-center font-bold bg-blue-400 text-blue-900 rounded-lg">
                                    <span class="">{{ $sp->solo_status }}</span>
                                </td>
                            @elseif ($sp->solo_status == 'expired')
                                <td
                                    class="px-4 py-3 uppercase text-center font-bold bg-red-400 text-red-900 rounded-lg">
                                    <span class="">{{ $sp->solo_status }}</span>
                                </td>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No Solo Parents found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $clients->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
