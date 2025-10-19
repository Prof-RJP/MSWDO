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
            <a href="{{ route('admin.add-senior') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <i class="fas fa-plus"></i> Add Seniors
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="font-bold text-2xl">Senior Cetizens Page</h1>
                <p class="italic text-gray-500">Manage and update Senior Cetizens information.</p>
            </div>
        </div>
        <!-- Barangay Grid Section -->
<div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-4 p-4">
    @foreach ($barangay as $brgy)
        <!-- Each barangay card -->
        <a href="{{ route('admin.view-senior',$brgy->id) }}">
        <div
            class="bg-gradient-to-br from-green-50 to-blue-50 dark:from-green-900 dark:to-blue-900 border border-green-200 dark:border-blue-700 rounded-2xl shadow-md hover:shadow-xl hover:scale-105 transition-transform duration-200 p-4 flex flex-col items-center justify-center text-center cursor-pointer"
        >
            <!-- Icon (green/blue accent) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-600 dark:text-blue-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 7v10a2 2 0 002 2h3v-4h4v4h3a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
            </svg>

            <!-- Barangay Name -->
            <h3 class="text-lg font-semibold text-green-800 dark:text-white">
                {{ $brgy->barangay }}
            </h3>
        </div>
        </a>
    @endforeach
</div>

    </div>
</x-app-layout>
