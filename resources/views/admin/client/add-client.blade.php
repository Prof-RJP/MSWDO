<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Client') }}
            </h2>
            <a href="{{ route('admin.client') }}"
                class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                <i class="fas fa-angle-left"></i>
                <span>Back</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-8 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Add New Client</h1>
        <p class="text-gray-500 mb-6">Fill in the information below to register a new client.</p>

        <form action="{{ route('client.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Camera Capture Section -->
            <div x-data="cameraApp()" x-init="initCamera()" class="mt-8 border-t pt-6">

                <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-camera text-blue-600"></i>
                    Take Client Photo
                </h2>

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Camera Preview -->
                    <div class="flex flex-col items-center">
                        <video x-ref="video" class="rounded-lg shadow-md border" width="320" height="240"
                            autoplay></video>

                        <button type="button" @click="capturePhoto"
                            class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            <i class="fas fa-camera mr-1"></i> Capture Photo
                        </button>
                    </div>

                    <!-- Captured Image Preview -->
                    <div class="flex flex-col items-center">
                        <template x-if="photo">
                            <img :src="photo" class="rounded-lg shadow-md border w-64 h-48 object-cover">
                        </template>

                        <template x-if="!photo">
                            <div
                                class="w-64 h-48 flex items-center justify-center border-2 border-dashed border-gray-300 text-gray-400 rounded-lg">
                                No photo captured
                            </div>
                        </template>

                        <button type="button" @click="retakePhoto" x-show="photo"
                            class="mt-3 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow transition">
                            <i class="fas fa-redo mr-1"></i> Retake
                        </button>
                    </div>
                </div>

                <!-- Hidden input to submit base64 image -->
                <input type="hidden" name="photo" x-model="photo">
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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                    <select id="civil_status" name="civil_status"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Select --</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                    <x-input-error :messages="$errors->get('civil_status')" class="mt-2" />
                </div>

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
                        <option value="">-- Select --</option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                        <option value="OTHER">Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="birthdate" :value="__('Birthdate')" />
                    <input type="date" name="birthdate"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="block w-full mt-1"
                    value="{{ old('address') }}" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Occupation -->
            <div>
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input id="occupation" name="occupation" type="text" class="block w-full mt-1"
                    value="{{ old('occupation') }}" />
                <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
            </div>

            <!-- Educational Attainment -->
            <div>
                <x-input-label for="educational_attainment" :value="__('Educational Attainment')" />
                <select id="educational_attainment" name="educational_attainment"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Select --</option>
                    <option value="Elementary">Elementary</option>
                    <option value="High School">High School</option>
                    <option value="College">College</option>
                    <option value="Post Graduate">Post Graduate</option>
                    <option value="Vocational">Vocational</option>
                </select>
                <x-input-error :messages="$errors->get('educational_attainment')" class="mt-2" />
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
