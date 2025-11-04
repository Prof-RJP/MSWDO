<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Solo Parent') }}
            </h2>
            <a href="{{ route('admin.soloParents') }}"
                class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                <i class="fas fa-angle-left"></i>
                <span>Back</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-8 bg-white shadow-lg rounded-lg p-8">

        <h1 class="text-2xl font-bold mb-4">Update Solo Parent</h1>

        <!-- IMPORTANT: PUT METHOD FOR UPDATE -->
        <form action="{{ route('soloParents.update', $soloParent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Parent Info -->
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <div>
                    <x-input-label value="ID No." />
                    <x-text-input name="id_no" class="w-full" value="{{ old('id_no', $soloParent->id_no) }}" />
                </div>

                <div>
                    <x-input-label value="Case No." />
                    <x-text-input name="case_no" class="w-full" value="{{ old('case_no', $soloParent->case_no) }}" />
                </div>

                <div>
                    <x-input-label value="Applied Date" />
                    <x-text-input type="date" name="applied_date" class="w-full"
                        value="{{ old('applied_date', $soloParent->applied_date) }}" />
                </div>
            </div>

            <!-- Select Client -->
            <div class="mt-4">
                <x-input-label value="Client Name" />
                <select name="client_id" class="w-full border-gray-300 rounded">
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $soloParent->client_id ? 'selected' : '' }}>
                            {{ $client->lname }}, {{ $client->fname }} {{ $client->mname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category, Benefits, Dates -->
            <div class="grid grid-cols-1 gap-2 md:grid-cols-4 mt-4">
                <div>
                    <x-input-label value="Category" />
                    <x-text-input name="category" class="w-full"
                        value="{{ old('category', $soloParent->category) }}" />
                </div>

                <div>
                    <x-input-label value="Benefits" />
                    <x-text-input name="benefits" class="w-full"
                        value="{{ old('benefits', $soloParent->benefits) }}" />
                </div>

                <div>
                    <x-input-label value="Expiration Date" />
                    <x-text-input type="date" name="exp_date" class="w-full"
                        value="{{ old('exp_date', $soloParent->exp_date) }}" />
                </div>

                <div>
                    <x-input-label value="Status" />
                    <select name="solo_status" class="w-full border-gray-300 rounded">
                        @foreach (['new', 'renew', 'expired'] as $ss)
                            <option value="{{ $ss }}" {{ $soloParent->solo_status == $ss ? 'selected' : '' }}>
                                {{ ucfirst($ss) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="my-6">

            <!-- CHILDREN SECTION -->
            <x-input-label value="Children" />

            <!-- Alpine.js load existing children -->
            {{-- Load children from database into AlpineJS --}}
<div x-data="{
    children: {{ json_encode($soloParent->children) }}
}">
    <x-input-label :value="__('Kids')" />

    {{-- Loop children fields --}}
    <template x-for="(child, index) in children" :key="index">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">

            {{-- Child Name --}}
            <input type="text"
                class="border rounded w-full"
                x-model="child.name"  {{-- ✅ binds existing value --}}
                :name="`children[${index}][name]`"
                placeholder="Child Name">

            {{-- Child Birthdate --}}
            <input type="date"
                class="border rounded w-full"
                x-model="child.birthdate"
                :name="`children[${index}][birthdate]`">

            {{-- Buttons --}}
            <div class="flex gap-2">
                {{-- Add New Child Row --}}
                <button type="button"
                    @click="children.push({name:'', birthdate:''})"
                    class="bg-blue-600 text-white px-3 rounded">
                    + Add
                </button>

                {{-- Remove Child --}}
                <button type="button"
                    @click="children.splice(index,1)"
                    class="bg-red-600 text-white px-3 rounded">
                    X
                </button>
            </div>

        </div>
    </template>
</div>

            <div class="text-right mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-lg">
                    Update Record
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
