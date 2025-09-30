<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('admin.add-client') }}"
                class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                <i class="fas fa-plus"></i>
                <span>Add Client</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Client List</h1>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.client') }}" class="mb-4 flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                class="border rounded-l px-3 py-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r shadow transition">
                Search
            </button>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold text-center">
                    <tr>
                        @php
                            function sortLink($field, $label, $sortField, $sortDirection)
                            {
                                $direction = $sortField === $field && $sortDirection === 'asc' ? 'desc' : 'asc';
                                $icon = '';
                                if ($sortField === $field) {
                                    $icon = $sortDirection === 'asc' ? '↑' : '↓';
                                }
                                return "<a href='?sort=$field&direction=$direction' class='flex justify-center items-center gap-1 hover:text-blue-600 transition'>$label $icon</a>";
                            }
                        @endphp

                        <th class="px-4 py-3 border">{!! sortLink('id', 'ID', $sortField, $sortDirection) !!}</th>
                        <th class="px-4 py-3 border">{!! sortLink('full_name', 'Full Name', $sortField, $sortDirection) !!}</th>
                        <th class="px-4 py-3 border">{!! sortLink('address', 'Address', $sortField, $sortDirection) !!}</th>
                        <th class="px-4 py-3 border">{!! sortLink('contact', 'Contact', $sortField, $sortDirection) !!}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                    @forelse($clients as $client)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('client.edit', $client->id) }}"
                                    class="block hover:text-blue-600">
                                    {{ $client->id }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('client.edit', $client->id) }}"
                                    class="block hover:text-blue-600">
                                    {{ $client->full_name }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('client.edit', $client->id) }}"
                                    class="block hover:text-blue-600">
                                    {{ $client->address }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('client.edit', $client->id) }}"
                                    class="block hover:text-blue-600">
                                    {{ $client->contact }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No clients found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $clients->links() }}
        </div>
    </div>
</x-app-layout>
