<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit AICS Record') }}
            </h2>
            <a href="{{ route('admin.AICS') }}"
               class="flex items-center bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow transition">
                <i class="fas fa-angle-left mr-2"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8 bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        <!-- Header -->
        <div class="mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">AICS Information Update</h1>
            <p class="text-gray-500 mt-1">Review and update the details for this AICS record.</p>
        </div>

        <!-- Form -->
        <form action="{{ route('AICS.update', $aics->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Client Information -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="client_id" :value="__('Select Client')" />
                    <select name="client_id" id="client_id"
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">-- Select Client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ $aics->client_id == $client->id ? 'selected' : '' }}>
                                {{ strtoupper($client->fname) }} {{ strtoupper($client->lname) }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="principal_client" :value="__('Principal Client')" />
                    <x-text-input id="principal_client" name="principal_client" type="text"
                        class="w-full mt-1" placeholder="Enter principal client name"
                        value="{{ old('principal_client', $aics->principal_client) }}" />
                    <x-input-error :messages="$errors->get('principal_client')" class="mt-2" />
                </div>
            </div>

            <!-- Medical Details -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="diagnosis" :value="__('Diagnosis')" />
                    <x-text-input id="diagnosis" name="diagnosis" type="text"
                        class="w-full mt-1" placeholder="Enter diagnosis"
                        value="{{ old('diagnosis', $aics->diagnosis) }}" />
                    <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="gis" :value="__('GIS (General Intake Sheet)')" />
                    <x-text-input id="gis" name="gis" type="text"
                        class="w-full mt-1" placeholder="Enter GIS number"
                        value="{{ old('gis', $aics->gis) }}" />
                    <x-input-error :messages="$errors->get('gis')" class="mt-2" />
                </div>
            </div>

            <!-- Assistance Type -->
            <div>
                <x-input-label for="assistance_type" :value="__('Type of Assistance')" />
                <select name="assistance_type" id="assistance_type"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">-- Select Assistance Type --</option>
                    <option value="Medical Assistance" {{ old('assistance_type', $aics->assistance_type ?? '') == 'Medical Assistance' ? 'selected' : '' }}>Medical Assistance</option>
                    <option value="Burial Assistance" {{ old('assistance_type', $aics->assistance_type ?? '') == 'Burial Assistance' ? 'selected' : '' }}>Burial Assistance</option>
                    <option value="Other Assistance" {{ old('assistance_type', $aics->assistance_type ?? '') == 'Other Assistance' ? 'selected' : '' }}>Other Assistance</option>
                </select>
                <x-input-error :messages="$errors->get('assistance_type')" class="mt-2" />
            </div>

            <!-- Date -->
            <div>
                <x-input-label for="created_at" :value="__('Date of Record')" />
                <input type="date" name="created_at" id="created_at"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('created_at', $aics->created_at->format('Y-m-d')) }}">
                <x-input-error :messages="$errors->get('created_at')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex justify-end pt-6 border-t mt-8">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition">
                    <i class="fas fa-save mr-2"></i> Update AICS Record
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
