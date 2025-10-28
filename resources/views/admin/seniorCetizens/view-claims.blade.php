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
                {{ __('Senior Cetizens') }}
            </h2>
            <div class="flex flex-row gap-3">
               
                <a href="{{ route('admin.senior') }}"
                class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                <i class="fas fa-angle-left"></i>
            </a>
            </div>

        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        

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
                    @if ($seniors)
                        <tr class="hover:bg-gray-200 cursor-pointer">
                            <td class="px-4 py-3 uppercase">{{ $seniors->osca_id }}</td>
                            <td class="px-4 py-3 uppercase">{{ $seniors->full_name }}</td>
                            <td class="px-4 py-3 uppercase">{{ $seniors->age }}</td>
                            <td class="px-4 py-3 uppercase">
                                
                            </td>
                            
                        </tr>

                    @else
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">No claims found</td>
                        </tr>
                    @endif

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $seniors->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
