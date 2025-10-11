<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit AICS') }}
            </h2>
            <a href="{{ route('admin.AICS') }}"
               class="flex items-center bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-angle-left mr-2"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6 p-6 bg-white shadow-lg rounded-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Edit AICS Record</h1>

        <form action="{{ route('AICS.update', $aics->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Client -->
            <div>
                <x-input-label for="client_id" :value="__('Client')" />
                <select name="client_id" id="client_id"
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">-- Select Client --</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $aics->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->fname }} {{ $client->lname }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
            </div>

            <!-- Principal Client -->
            <div>
                <x-input-label for="principal_client" :value="__('Principal Client')" />
                <x-text-input id="principal_client" name="principal_client" type="text"
                              class="w-full mt-1"
                              placeholder="Enter principal client name"
                              value="{{ old('principal_client', $aics->principal_client) }}" />
                <x-input-error :messages="$errors->get('principal_client')" class="mt-2" />
            </div>

            <!-- Diagnosis -->
            <div>
                <x-input-label for="diagnosis" :value="__('Diagnosis')" />
                <x-text-input id="diagnosis" name="diagnosis" type="text"
                              class="w-full mt-1"
                              placeholder="Enter diagnosis"
                              value="{{ old('diagnosis', $aics->diagnosis) }}" />
                <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
            </div>

            <!-- GIS -->
            <div>
                <x-input-label for="gis" :value="__('GIS')" />
                <x-text-input id="gis" name="gis" type="text"
                              class="w-full mt-1"
                              placeholder="Enter GIS"
                              value="{{ old('gis', $aics->gis) }}" />
                <x-input-error :messages="$errors->get('gis')" class="mt-2" />
            </div>

            <!-- Date Created -->
            <div>
                <x-input-label for="created_at" :value="__('Date Created')" />
                <input type="date" name="created_at" id="created_at"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('created_at', $aics->created_at->format('Y-m-d')) }}">
                <x-input-error :messages="$errors->get('created_at')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex justify-end pt-4 border-t mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
