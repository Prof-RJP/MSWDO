<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('AICS') }}
            </h2>
            <a href="{{ route('admin.add-AICS') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <i class="fas fa-plus"></i> Add AICS
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">AICS Page</h1>
                <p class="italic text-gray-500">Update or add your AICS data.</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.AICS') }}" class="flex items-center space-x-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search clients..."
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

                        <th class="px-4 py-3 text-left">{!! sort_link('id', '#', $sort, $direction) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('client_id', 'Client Name', $sort, $direction) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('principal_client', 'Principal Client', $sort, $direction) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('gis', 'GIS', $sort, $direction) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sort_link('created_at', 'Date', $sort, $direction) !!}</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($aics as $aic)
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('AICS.edit', $aic->id) }}'">
                            <td class="px-4 py-3">{{ $aic->id }}</td>
                            <td class="px-4 py-3 uppercase">
                                {{ $aic->client ? $aic->client->fname . ' ' . ($aic->client->mname ?? '') . ' ' . $aic->client->lname : '' }}
                            </td>
                            <td class="px-4 py-3 uppercase">{{ $aic->principal_client }}</td>
                            <td class="px-4 py-3 uppercase">{{ $aic->gis }}</td>
                            <td class="px-4 py-3">{{ $aic->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $aics->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
