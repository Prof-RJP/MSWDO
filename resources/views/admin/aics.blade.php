<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('AICS') }}
            </h2>
            <a href="{{ route('admin.add-AICS') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg"><span><i
                        class="fas fa-plus"></i></span> Add AICS</a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex flex-row items-center justify-between">
            <div class="ml-6 flex-1">
                <h1 class="font-bold font-sans text-2xl">AICS Page</h1>
                <p class="italic">Update or add your AICS data.</p>
            </div>
            {{-- <div class="flex-1 ">
                <form action="">
                    <div class="flex flex-row">
                        <x-text-input class="w-full translate-x-2" x-mo></x-text-input>
                        <input type="submit" value="Search" class="bg-green-700 text-white cursor-pointer px-3 py-2 z-10 rounded-r-lg">
                    </div>

                </form>

            </div> --}}

        </div>




        <div class="mt-4">

            <div class="max-w-6xl mx-auto">

                <div x-data="sortableTable({{ $aics->toJson() }})" class="bg-white shadow rounded-lg overflow-hidden">
                    <!-- Search bar -->
                    <div class="p-4 border-b">
                        <input x-model="q" type="text" placeholder="Search clients..."
                            class="w-64 px-3 py-1 rounded border focus:outline-none focus:ring">
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-100 text-sm text-gray-600">
                                <tr>
                                    <th class="px-4 py-3 text-left" @click="sortBy('id')">#</th>
                                    <th class="px-4 py-3 text-left" @click="sortBy('client_id')">Client Name</th>
                                    <th class="px-4 py-3 text-left" @click="sortBy('principal_client')">Principal Client
                                    </th>
                                    <th class="px-4 py-3 text-left" @click="sortBy('gis')">GIS</th>
                                    <th class="px-4 py-3 text-left" @click="sortBy('created_at')">Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y">
                                <template x-for="aic in filteredSorted()" :key="aic.id">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3" x-text="aic.id"></td>
                                        <td class="px-4 py-3"
                                            x-text="aic.client ? (aic.client.fname + ' ' + (aic.client.mname ?? '') + ' ' + aic.client.lname) : ''">
                                        </td>
                                        <td class="px-4 py-3" x-text="aic.principal_client"></td>
                                        <td class="px-4 py-3" x-text="aic.gis"></td>
                                        <td class="px-4 py-3"
                                            x-text="new Date(aic.created_at).toLocaleDateString('en-US')"></td>


                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sortableTable(data) {
            return {
                q: '',
                sortKey: 'id',
                sortAsc: true,
                items: data,

                sortBy(key) {
                    if (this.sortKey === key) {
                        this.sortAsc = !this.sortAsc;
                    } else {
                        this.sortKey = key;
                        this.sortAsc = true;
                    }
                },

                filteredSorted() {
                    let arr = this.items.filter(i => {
                        let search = this.q.toLowerCase();
                        let fullName = '';
                        if (i.client) {
                            fullName = (i.client.fname + ' ' + (i.client.mname ?? '') + ' ' + i.client.lname)
                                .toLowerCase();
                        }
                        return fullName.includes(search);
                    });

                    arr.sort((a, b) => {
                        let va = a[this.sortKey] ?? '';
                        let vb = b[this.sortKey] ?? '';

                        if (typeof va === 'number' && typeof vb === 'number') {
                            return (va - vb) * (this.sortAsc ? 1 : -1);
                        }
                        return String(va).localeCompare(String(vb)) * (this.sortAsc ? 1 : -1);
                    });

                    return arr;
                }
            }
        }
    </script>

</x-app-layout>
