<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Clients') }}
            </h2>
            <a href="{{ route('admin.client') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg"><span><i
                        class="fas fa-angle-left"></i></span></a>
        </div>
    </x-slot>
    <div class="m-5 p-5 bg-white shadow-md rounded-md">

        <form action="{{ route('client.store') }}" method="post">
            @csrf
            <div class="flex flex-row gap-5 mb-5">
                <div class="flex-1">
                    <x-input-label for="lname" :value="__('Last Name')" />
                    <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname"
                        :value="old('lname')"  autofocus autocomplete="lname" />
                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                </div>
                <div class="flex-1">
                    <x-input-label for="fname" :value="__('First Name')" />
                    <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname"
                        :value="old('fname')"  autofocus autocomplete="fname" />
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div>
                <div class="flex-1">
                    <x-input-label for="mname" :value="__('Middle Name')" />
                    <x-text-input id="mname" class="block mt-1 w-full" type="text" name="mname"
                        :value="old('mname')"  autofocus autocomplete="mname" />
                    <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                </div>
            </div>
            <div class="flex flex-row gap-5 mb-5">
                <div class="flex-1">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')"  autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div class="flex-1">
                    <x-input-label for="contact" :value="__('Contact Number')" />
                    <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact"
                        :value="old('contact')"  autofocus autocomplete="contact" />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>
                <div class="flex-1">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                        <option value="OTHER">OTHER</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>
            <input type="submit" value="Submit" class="bg-blue-600 text-white px-3 py-2 rounded-md">

        </form>

    </div>

</x-app-layout>
