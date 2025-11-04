<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Solo Parents') }}
            </h2>
            <a href="{{ route('admin.soloParents') }}"
                class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                <i class="fas fa-angle-left"></i>
                <span>Back</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-8 bg-white shadow-lg rounded-lg p-8 motion-preset-slide-right-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Add Solo Parents</h1>
        <p class="text-gray-500 mb-6">Fill in the information below to register a new solo parents.</p>

        <form action="{{ route('soloparents.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <div class="mb-2">
                    <x-input-label for="id_no" :value="__('ID No.')" />
                    <x-text-input name="id_no" class="w-full" id="id_no" type="text"
                        value="{{ old('id_no') }}" placeholder="ID number" />
                    <x-input-error :messages="$errors->get('id_no')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <x-input-label for="case_no" :value="__('Case No.')" />
                    <x-text-input name="case_no" value="{{ old('case_no') }}" class="w-full" id="case_no"
                        type="text" placeholder="Case number" />
                    <x-input-error :messages="$errors->get('case_no')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <x-input-label for="applied_date" :value="__('Applied Date')" />
                    <x-text-input name="applied_date" class="w-full" value="{{ old('applied_date') }}" id="applied_date"
                        type="date" placeholder="ID number" />
                    <x-input-error :messages="$errors->get('applied_date')" class="mt-2" />
                </div>
            </div>

            <!-- Name Fields -->
            <div class="mb-5">
                <x-input-label for="client_id" :value="__('Select Client')" />
                <select id="client_id" name="client_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Choose a client --</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->lname }}, {{ $client->fname }} {{ $client->mname }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 gap-2 md:grid-cols-4">
                <div class="mb-2">
                    <x-input-label for="category" :value="__('Category')" />
                    <x-text-input name="category" class="w-full" id="category" type="text"
                        value="{{ old('category') }}" placeholder="Category" />
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <x-input-label for="benefits" :value="__('Benefit')" />
                    <x-text-input name="benefits" class="w-full" id="benefits" value="{{ old('benefits') }}"
                        type="text" placeholder="Benefit" />
                    <x-input-error :messages="$errors->get('benefits')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <x-input-label for="exp_date" :value="__('Expiration Date')" />
                    <x-text-input name="exp_date" class="w-full" id="exp_date" type="date" placeholder="ID number"
                        value="{{ old('exp_date') }}" />
                    <x-input-error :messages="$errors->get('exp_date')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <x-input-label for="solo_status" :value="__('Status')" />
                    <select name="solo_status" id="solo_status"
                        class="w-full capitalize border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                        @foreach (['new', 'renew', 'expired'] as $ss)
                            <option value="{{ $ss }}">{{ $ss }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div x-data="{ children: [{ name: '', birthdate: '' }] }">
                <x-input-label :value="__('Name of Kids')" />

                <template x-for="(child, index) in children" :key="index">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 items-center">

                        <!-- Child Name -->
                        <input type="text" class="w-full border rounded-md" x-model="child.name"
                            :name="`children[${index}][name]`" placeholder="Child Name" />

                        <!-- Birthdate -->
                        <input type="date" class="w-full border rounded-md" x-model="child.birthdate"
                            :name="`children[${index}][birthdate]`" />

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <button type="button" @click="children.push({ name:'', birthdate:'' })"
                                class="bg-blue-600 text-white px-3 py-1 rounded">
                                + Add
                            </button>

                            <button type="button" @click="children.splice(index, 1)"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                X
                            </button>
                        </div>

                    </div>
                </template>
            </div>



            </template>
            <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-md transition-all">
            <i class="fas fa-save mr-1"></i> Submit
        </button>
    </div>
    </div>

    </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect("#client_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Search client name...",
            });
        });
    </script>
</x-app-layout>
