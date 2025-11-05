<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif
        });
    </script>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Senior Cetizens') }}
            </h2>

        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div class="motion-preset-slide-down-right-md">
                <h1 class="font-bold text-2xl">Senior Cetizens Page</h1>
                <p class="italic text-gray-500">Manage and update Senior Cetizens information.</p>
            </div>
        </div>
        <!-- Barangay Grid Section -->
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-4 p-4 motion-preset-slide-right-sm">
            <!-- Card for ALL Seniors -->
            <a href="{{ route('senior.all') }}">
                    <div
                        class="bg-white dark:bg-gray-900 border border-green-300 dark:border-blue-700 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform duration-200 p-5 flex flex-col gap-2 cursor-pointer">

                        <!-- Icon -->
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-600 dark:text-blue-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h3v-4h4v4h3a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </div>

                        <!-- Barangay Name -->
                        <h3 class="text-xl font-bold text-center text-green-700 dark:text-white">
                            ALL BARANGAYS
                        </h3>
                    </div>
                </a>

            @foreach ($barangay as $brgy)
                <a href="{{ route('admin.view-senior', $brgy->id) }}">
                    <div
                        class="bg-white dark:bg-gray-900 border border-green-300 dark:border-blue-700 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition-transform duration-200 p-5 flex flex-col gap-2 cursor-pointer">

                        <!-- Icon -->
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-600 dark:text-blue-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h3v-4h4v4h3a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </div>

                        <!-- Barangay Name -->
                        <h3 class="text-xl font-bold text-center text-green-700 dark:text-white">
                            {{ strtoupper($brgy->barangay) }}
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>


    </div>
</x-app-layout>
