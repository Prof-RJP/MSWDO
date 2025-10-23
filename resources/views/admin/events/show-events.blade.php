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
                {{ $event->title }}
            </h2>
            <a href="{{ route('admin.events') }}"
                class="bg-green-700 text-white px-3 py-2 rounded-lg hover:bg-green-800 transition">
                <i class="fas fa-arrow-left"></i> Back to Events
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">Birthday Celebrants</h1>
                <p class="italic text-gray-500">
                    Celebrants for {{ \Carbon\Carbon::parse($event->starts_at)->format('F Y') }}
                </p>
            </div>

            <!-- ✅ Filter + Search -->
            <form method="GET" action="{{ route('claims.index', $event->id) }}" class="flex items-center space-x-2">
                <select name="barangay" class="border rounded-lg px-3 py-1">
                    <option value="">All Barangays</option>
                    @foreach ($barangay as $b)
                        <option value="{{ $b->id }}" {{ $barangayFilter == $b->id ? 'selected' : '' }}>
                            {{ $b->barangay }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search seniors..."
                    class="border rounded-lg px-3 py-1 focus:ring focus:ring-green-200">
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded-lg">Search</button>
            </form>
        </div>

        @php
            // Filter celebrants based on Active status
            $activeCelebrants = $celebrants->filter(function ($senior) {
                return $senior->status === 'Active';
            });

            // If a barangay filter is applied, filter further
            if (!empty($barangayFilter)) {
                $activeCelebrants = $activeCelebrants->where('brgy_id', $barangayFilter);
            }

            // Count total active celebrants
            $totalCelebrants = $activeCelebrants->count();

            // Count claimed among the filtered ones
            $claimedCount = $activeCelebrants
                ->filter(function ($senior) use ($claims) {
                    $claim = $claims->firstWhere('sr_id', $senior->id);
                    return $claim && $claim->status === 'claimed';
                })
                ->count();

            // Unclaimed = remaining
            $unclaimedCount = $totalCelebrants - $claimedCount;

            function sort_link($column, $label, $sortField, $sortDirection) {
                $newDir = ($sortField === $column && $sortDirection === 'asc') ? 'desc' : 'asc';
                $arrow = $sortField === $column ? ($sortDirection === 'asc' ? '↑' : '↓') : '';
                $query = http_build_query(array_merge(request()->all(), ['sort' => $column, 'direction' => $newDir]));
                return "<a href='?".e($query)."' class='flex items-center'>{$label} {$arrow}</a>";
            }
        @endphp


        <!-- ✅ Summary Counters -->
        <div class="flex flex-wrap items-center gap-4 mb-6">
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg font-semibold shadow-sm">
        Claimed: {{ $claimedCount }}
    </div>
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg font-semibold shadow-sm">
        Unclaimed: {{ $unclaimedCount }}
    </div>
    <div class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow-sm">
        Total Celebrants: {{ $totalCelebrants }}
    </div>
</div>
        <!-- ✅ Table -->
        <div class="overflow-x-auto">
            @if ($celebrants->isEmpty())
                <p class="text-gray-500 text-center py-6">No birthday celebrants this month.</p>
            @else
                <table class="min-w-full table-auto border">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">{!! sort_link('id', 'Name', $sortField, $sortDirection) !!}</th>
                            <th class="px-4 py-3 text-left">{!! sort_link('birthdate', 'Birthday', $sortField, $sortDirection) !!}</th>
                            <th class="px-4 py-3 text-left">Age</th>
                            <th class="px-4 py-3 text-center">{!! sort_link('barangay_id', 'Barangay', $sortField, $sortDirection) !!}</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($celebrants as $senior)
                            @php
                                $claim = $claims->firstWhere('senior_id', $senior->id);
                            @endphp
                            <tr class="hover:bg-gray-50">
                                @if ($senior->status == 'Active')
                                    <td class="px-4 py-3 uppercase">{{ $senior->lname }}, {{ $senior->fname }}
                                        {{ $senior->mname ?? '' }}</td>
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($senior->birthdate)->format('F d') }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($senior->birthdate)->age }}</td>
                                    <td class="px-4 py-3 text-center">
                                        {{ $senior->barangay->barangay ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if ($claim && $claim->status === 'claimed')
                                            <span
                                                class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Claimed</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">Unclaimed</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if (!$claim || $claim->status === 'unclaimed')
                                            <form method="POST" action="{{ route('claims.store') }}">
                                                @csrf
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <input type="hidden" name="senior_id" value="{{ $senior->id }}">
                                                <button type="submit"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md">
                                                    Mark as Claimed
                                                </button>
                                            </form>
                                        @else
                                            <button disabled
                                                class="bg-gray-300 text-gray-700 px-3 py-1 rounded-md">Claimed</button>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
