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
            <div class="flex flex-row gap-5 mb-5">
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
            <div class="flex flex-row gap-5 mb-5">
                <div class="flex-1">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        value="{{ old('address', $client->address) }}" autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
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
                        <option value="MALE" {{ old('gender', $client->gender) == 'MALE' ? 'selected' : '' }}>MALE</option>
                        <option value="FEMALE" {{ old('gender', $client->gender) == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                        <option value="OTHER" {{ old('gender', $client->gender) == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                Update Client
            </button>
        </form>
    </div>
</x-app-layout>
