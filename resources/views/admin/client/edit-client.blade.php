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
        <p class="text-gray-500 mb-6">Modify the client’s information below and click <b>Update Client</b> to save
            changes.</p>

        <form action="{{ route('client.update', $client->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- <!-- ==========================
     📸 CAMERA CAPTURE SECTION
     ========================== -->
            <div x-data="cameraApp()" <!-- Initialize Alpine.js reactive component -->
                x-init="initCamera()" <!-- Run initCamera() when this section loads -->
                class="mt-8 border-t pt-6">

                <!-- Section title -->
                <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-camera text-blue-600"></i>
                    Take Client Photo
                </h2>

                <!-- Main layout: two columns (video + photo preview) -->
                <div class="flex flex-col md:flex-row gap-6">

                    <!-- ================================
             🎥 LEFT SIDE: CAMERA PREVIEW
             ================================ -->
                    <div class="flex flex-col items-center">

                        <!-- Video element shows live camera feed -->
                        <video x-ref="video" <!-- This will be referenced inside Alpine -->
                            class="rounded-lg shadow-md border"
                            width="320"
                            height="240"
                            autoplay>
                        </video>

                        <!-- Button to capture photo from the live feed -->
                        <button type="button" @click="capturePhoto" <!-- When clicked, run capturePhoto() -->
                            class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            <i class="fas fa-camera mr-1"></i> Capture Photo
                        </button>
                    </div>

                    <!-- ================================
             🖼️ RIGHT SIDE: CAPTURED IMAGE PREVIEW
             ================================ -->
                    <div class="flex flex-col items-center">

                        <!-- This will show when photo is captured -->
                        <template x-if="photo">
                            <!-- Bind the captured base64 image to the <img> tag -->
                            <img :src="photo" class="rounded-lg shadow-md border w-64 h-48 object-cover">
                        </template>

                        <!-- This will show when no photo is captured yet -->
                        <template x-if="!photo">
                            <div
                                class="w-64 h-48 flex items-center justify-center border-2 border-dashed border-gray-300 text-gray-400 rounded-lg">
                                No photo captured
                            </div>
                        </template>

                        <!-- Retake button (only visible when a photo exists) -->
                        <button type="button" @click="retakePhoto" <!-- When clicked, clear the photo -->
                            x-show="photo" <!-- Only show if a photo exists -->
                            class="mt-3 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow transition">
                            <i class="fas fa-redo mr-1"></i> Retake
                        </button>
                    </div>
                </div>

                <!-- Hidden input field to send captured photo (base64) with the form -->
                <input type="hidden" name="photo" x-model="photo">
            </div>


            <!-- =========================================
     🧠 JAVASCRIPT PART — ALPINE.JS COMPONENT
     ========================================= -->
            <script>
                function cameraApp() {
                    return {
                        /* =======================
                           💾 REACTIVE VARIABLES
                           ======================= */
                        video: null, // will hold the <video> element reference
                        photo: '', // will store the captured photo (base64)
                        stream: null, // will store the camera stream

                        /* =======================
                           🎥 INITIALIZE CAMERA
                           ======================= */
                        async initCamera() {
                            try {
                                // Get reference to the <video> element from x-ref
                                this.video = this.$refs.video;

                                // Ask for permission and start video stream
                                this.stream = await navigator.mediaDevices.getUserMedia({
                                    video: true
                                });

                                // Show the camera stream inside the <video> tag
                                this.video.srcObject = this.stream;
                            } catch (error) {
                                // If user denies or camera is not available
                                alert('Unable to access camera. Please allow permission.');
                            }
                        },

                        /* =======================
                           📸 CAPTURE A PHOTO
                           ======================= */
                        capturePhoto() {
                            // Create an invisible <canvas> element
                            const canvas = document.createElement('canvas');

                            // Match canvas size to video feed size
                            canvas.width = this.video.videoWidth;
                            canvas.height = this.video.videoHeight;

                            // Draw the current video frame on the canvas
                            const context = canvas.getContext('2d');
                            context.drawImage(this.video, 0, 0, canvas.width, canvas.height);

                            // Convert the drawn image into a base64 PNG string
                            this.photo = canvas.toDataURL('image/png');

                            // At this point:
                            //  - photo variable contains the base64 string (e.g. data:image/png;base64,iVBORw0KGgo...)
                            //  - It automatically updates the <img> preview
                            //  - It also fills the hidden input for form submission
                        },

                        /* =======================
                           🔄 RETAKE THE PHOTO
                           ======================= */
                        retakePhoto() {
                            // Clear the captured photo
                            this.photo = '';
                            // This hides the preview and shows the live video again
                        }
                    }
                }
            </script>
 --}}

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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div>
                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                    <select id="civil_status" name="civil_status"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-200 focus:border-green-500">
                        <option value="">-- Select --</option>
                        @foreach (['Single', 'Married', 'Widowed', 'Separated'] as $status)
                            <option value="{{ $status }}"
                                {{ old('civil_status', $client->civil_status) == $status ? 'selected' : '' }}>
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
                        @foreach (['MALE', 'FEMALE', 'OTHER'] as $g)
                            <option value="{{ $g }}"
                                {{ old('gender', $client->gender) == $g ? 'selected' : '' }}>{{ $g }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="birthdate" :value="__('Birthdate')" />
                    <input type="date" name="birthdate" value="{{ old('birthdate', $client->birthdate) }}"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                </div>
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="brgy_id" :value="__('Address')" />
                <select id="brgy_id" name="brgy_id"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-200 focus:border-green-500">
                    @foreach ($barangay as $brgy)
                        <option value="{{ $brgy->id }}" {{ old('brgy_id', $client->brgy_id) == $brgy->id ? 'selected' : '' }}>
                            {{ $brgy->barangay }}
                        </option>
                    @endforeach
                </select>
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
                    @foreach (['Elementary', 'High School', 'College', 'Post Graduate', 'Vocational'] as $level)
                        <option value="{{ $level }}"
                            {{ old('educational_attainment', $client->educational_attainment) == $level ? 'selected' : '' }}>
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
