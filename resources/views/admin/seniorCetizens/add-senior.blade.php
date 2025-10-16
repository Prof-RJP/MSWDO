<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Senior Cetizens') }}
            </h2>
            <a href="{{ route('admin.senior') }}"
                class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                <i class="fas fa-angle-left"></i>
                <span>Back</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-8 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Add Senior Cetizen</h1>
        <p class="text-gray-500 mb-6">Fill in the information below to register a Senior Cetizen.</p>

        <form action="{{ route('senior.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Address -->
            <div class="grid lg:grid-cols-2 gap-6">

                <div>
                    <x-input-label for="osca_id" :value="__('OSCA ID')" />
                    <x-text-input id="osca_id" name="osca_id" type="text" class="block w-full mt-1" />
                    <x-input-error :messages="$errors->get('osca_id')" class="mt-2" />

                </div>
                <div>
                    <x-input-label for="brgy_id" :value="__('Barangay')" />
                    <select name="brgy_id" id=" "
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                        <option value="" disabled selected>--Select Barangay--</option>
                        @foreach ($barangay as $brgy)
                            <option value="{{ $brgy->id }}">{{ $brgy->barangay }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('brgy_id')" class="mt-2" />
                </div>
            </div>


            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <x-input-label for="lname" :value="__('Last Name')" />
                    <x-text-input id="lname" name="lname" type="text" class="block w-full mt-1"
                        value="{{ old('lname') }}" />
                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="fname" :value="__('First Name')" />
                    <x-text-input id="fname" name="fname" type="text" class="block w-full mt-1"
                        value="{{ old('fname') }}" />
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="mname" :value="__('Middle Name')" />
                    <x-text-input id="mname" name="mname" type="text" class="block w-full mt-1"
                        value="{{ old('mname') }}" />
                    <x-input-error :messages="$errors->get('mname')" class="mt-2" />
                </div>
            </div>

            <!-- Contact, Gender, Civil Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


                <div>
                    <x-input-label for="contact" :value="__('Contact Number')" />
                    <x-text-input id="contact" name="contact" type="text" class="block w-full mt-1"
                        value="{{ old('contact') }}" />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                        <option disabled selected>-- Select --</option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="birthdate" :value="__('Birthdate')" />
                    <input type="date" name="birthdate"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />

                </div>
            </div>






            <!-- Educational Attainment -->
            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select id="status" name="status"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                    <option value="Active">Active</option>
                    <option value="Deceased">Deceased</option>

                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-md transition-all">
                    <i class="fas fa-save mr-1"></i> Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
