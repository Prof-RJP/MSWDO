<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add AICS') }}
            </h2>
            <a href="{{ route('admin.AICS') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <span><i class="fas fa-angle-left"></i></span>
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <form action="{{ route('AICS.store') }}" method="POST">
            @csrf

            <!-- Client -->
            <div class="mb-5">
                <x-input-label for="client_id" :value="__('Select Client')" />
                <select id="client_id" name="client_id"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Choose a client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->lname }}, {{ $client->fname }} {{ $client->mname }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
            </div>

            <!-- Principal Client -->
            <div class="mb-5">
                <x-input-label for="principal_client" :value="__('Principal Client')" />
                <x-text-input id="principal_client" class="block mt-1 w-full"
                              type="text" name="principal_client" :value="old('principal_client')" />
                <x-input-error :messages="$errors->get('principal_client')" class="mt-2" />
            </div>

            <!-- Civil Status -->
            <div class="mb-5">
                <x-input-label for="civil_status" :value="__('Civil Status')" />
                <select id="civil_status" name="civil_status"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select --</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Separated">Separated</option>
                </select>
                <x-input-error :messages="$errors->get('civil_status')" class="mt-2" />
            </div>

            <!-- Occupation -->
            <div class="mb-5">
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input id="occupation" class="block mt-1 w-full"
                              type="text" name="occupation" :value="old('occupation')" />
                <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
            </div>

            <!-- GIS -->
            <div class="mb-5">
                <x-input-label for="gis" :value="__('GIS')" />
                <select id="gis" name="gis"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select --</option>
                    <option value="Medical Assistance">Medical Assistance</option>
                    <option value="Burial Assistance">Burial Assistance</option>

                </select>
                <x-input-error :messages="$errors->get('gis')" class="mt-2" />
            </div>

            <!-- Educational Attainment -->
            <div class="mb-5">
                <x-input-label for="educational_attainment" :value="__('Educational Attainment')" />
                <select id="educational_attainment" name="educational_attainment"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select --</option>
                    <option value="Elementary">Elementary</option>
                    <option value="High School">High School</option>
                    <option value="College">College</option>
                    <option value="Post Graduate">Post Graduate</option>
                    <option value="Vocational">Vocational</option>
                </select>
                <x-input-error :messages="$errors->get('educational_attainment')" class="mt-2" />
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="bg-blue-600 text-white px-3 py-2 rounded-md">
                Submit
            </button>
        </form>
    </div>
</x-app-layout>
