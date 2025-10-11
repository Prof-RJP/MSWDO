<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Client Information') }}
            </h2>
            <a href="{{ route('admin.client') }}"
                class="flex items-center bg-green-700 hover:bg-green-800 text-white px-3 py-2 rounded-lg transition duration-200">
                <i class="fas fa-angle-left mr-1"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-6 bg-white shadow-lg rounded-lg p-8 border border-gray-100">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Update Client Details</h3>
        <p class="text-gray-500 mb-6">Modify the client’s information below and click <b>Update Client</b> to save changes.</p>

        <form action="{{ route('client.update', $client->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Names -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <x-input-label for="lname" :value="__('Last Name')" />
                    <x-text-input id="lname" name="lname" type="text" class="w-full"
                        value="{{ old('lname', $client->lname) }}" />
                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="fname" :value="__('First Name')" />
                    <x-text-input id="fname" name="fname" type="text" class="w-full"
                        value="{{ old('fname', $client->fname) }}" />
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="mname" :value="__('Middle Name')" />
                    <x-text-input id="mname" name="mname" type="text" class="w-full"
                        value="{{ old('mname', $client->mname) }}" />
                    <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                </div>
            </div>

            <!-- Civil Status / Contact / Gender -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                    <select id="civil_status" name="civil_status"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-200 focus:border-green-500">
                        <option value="">-- Select --</option>
                        @foreach(['Single', 'Married', 'Widowed', 'Separated'] as $status)
                            <option value="{{ $status }}" {{ old('civil_status', $client->civil_status) == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('civil_status')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="contact" :value="__('Contact Number')" />
                    <x-text-input id="contact" name="contact" type="text" class="w-full"
                        value="{{ old('contact', $client->contact) }}" />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-200 focus:border-green-500">
                        @foreach(['MALE', 'FEMALE', 'OTHER'] as $g)
                            <option value="{{ $g }}" {{ old('gender', $client->gender) == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="w-full"
                    value="{{ old('address', $client->address) }}" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Occupation -->
            <div>
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input id="occupation" name="occupation" type="text" class="w-full"
                    value="{{ old('occupation', $client->occupation) }}" />
                <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
            </div>

            <!-- Educational Attainment -->
            <div>
                <x-input-label for="educational_attainment" :value="__('Educational Attainment')" />
                <select id="educational_attainment" name="educational_attainment"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-200 focus:border-green-500">
                    <option value="">-- Select --</option>
                    @foreach(['Elementary', 'High School', 'College', 'Post Graduate', 'Vocational'] as $level)
                        <option value="{{ $level }}" {{ old('educational_attainment', $client->educational_attainment) == $level ? 'selected' : '' }}>
                            {{ $level }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('educational_attainment')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow transition duration-200">
                    <i class="fas fa-save mr-2"></i> Update Client
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
