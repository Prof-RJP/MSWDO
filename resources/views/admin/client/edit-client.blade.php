<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Clients') }}
            </h2>
            <a href="{{ route('admin.client') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <i class="fas fa-angle-left"></i>
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <!-- Update Client Form -->
        <form action="{{ route('client.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Names -->
            <div class="flex sm:flex-row flex-col gap-5 mb-5">
                <div class="flex-1">
                    <x-input-label for="lname" :value="__('Last Name')" />
                    <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname"
                        value="{{ old('lname', $client->lname) }}" autocomplete="lname" />
                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                </div>

                <div class="flex-1">
                    <x-input-label for="fname" :value="__('First Name')" />
                    <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname"
                        value="{{ old('fname', $client->fname) }}" autocomplete="fname" />
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div>

                <div class="flex-1">
                    <x-input-label for="mname" :value="__('Middle Name')" />
                    <x-text-input id="mname" class="block mt-1 w-full" type="text" name="mname"
                        value="{{ old('mname', $client->mname) }}" autocomplete="mname" />
                    <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                </div>
            </div>

            <!-- Address / Contact / Gender -->
            <div class="flex sm:flex-row flex-col gap-5 mb-5">
                <div class="flex-1">
                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                    <select id="civil_status" name="civil_status"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Select --</option>
                        <option value="Single"
                            {{ old('civil_status', $client->civil_status) == 'Single' ? 'selected' : '' }}>Single
                        </option>
                        <option value="Married"
                            {{ old('civil_status', $client->civil_status) == 'Married' ? 'selected' : '' }}>Married
                        </option>
                        <option value="Widowed"
                            {{ old('civil_status', $client->civil_status) == 'Widowed' ? 'selected' : '' }}>Widowed
                        </option>
                        <option value="Separated"
                            {{ old('civil_status', $client->civil_status) == 'Separated' ? 'selected' : '' }}>Separated
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('civil_status')" class="mt-2" />

                </div>

                <div class="flex-1">
                    <x-input-label for="contact" :value="__('Contact Number')" />
                    <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact"
                        value="{{ old('contact', $client->contact) }}" autocomplete="contact" />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>

                <div class="flex-1">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="MALE" {{ old('gender', $client->gender) == 'MALE' ? 'selected' : '' }}>MALE
                        </option>
                        <option value="FEMALE" {{ old('gender', $client->gender) == 'FEMALE' ? 'selected' : '' }}>
                            FEMALE</option>
                        <option value="OTHER" {{ old('gender', $client->gender) == 'OTHER' ? 'selected' : '' }}>OTHER
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>
            <div class="mb-5">

                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                    value="{{ old('address', $client->address) }}" autocomplete="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Occupation -->
            <div class="mb-5">
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input id="occupation" class="block mt-1 w-full" type="text" name="occupation"
                    :value="old('occupation')" value="{{ old('address', $client->occupation) }}"/>
                <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
            </div>
            <!-- Educational Attainment -->
            <div>
                <div class="mb-5">
                    <x-input-label for="educational_attainment" :value="__('Educational Attainment')" />
                    <select id="educational_attainment" name="educational_attainment"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Select --</option>
                        <option value="Elementary" {{ old('educational_attainment', $client->educational_attainment) == "Elementary" ? 'selected': '' }}>Elementary</option>
                        <option value="High School" {{ old('educational_attainment', $client->educational_attainment) == "High School" ? 'selected': '' }}>High School</option>
                        <option value="College" {{ old('educational_attainment', $client->educational_attainment) == "College" ? 'selected': '' }}>College</option>
                        <option value="Post Graduate" {{ old('educational_attainment', $client->educational_attainment) == "Post Graduate" ? 'selected': '' }}>Post Graduate</option>
                        <option value="Vocational" {{ old('educational_attainment', $client->educational_attainment) == "Vocational" ? 'selected': '' }}>Vocational</option>
                    </select>
                    <x-input-error :messages="$errors->get('educational_attainment')" class="mt-2" />
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                Update Client
            </button>
        </form>
    </div>
</x-app-layout>
