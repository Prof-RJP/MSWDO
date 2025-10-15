<x-app-layout>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('error'))
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: "{{ session('error') }}"
                    });
                @endif
            });
        </script>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Barangay') }}
            </h2>
            <a href="{{ route('admin.barangay') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <span><i class="fas fa-angle-left"></i></span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-8 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Add Barangay</h1>
        <p class="text-gray-500 mb-6">Fill in the information below to register a barangay.</p>
        <form action="{{ route('barangay.store') }}" method="POST">
            @csrf

            <!-- barangay -->
            <div class="mb-5">
                <x-input-label for="barangay" :value="__('Barangay')" />
                <x-text-input id="barangay" class="block mt-1 w-full"
                              type="text" name="barangay" :value="old('barangay')" />
                <x-input-error :messages="$errors->get('barangay')" class="mt-2" />
            </div>




            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 w-full hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-md transition-all">
                    <i class="fas fa-save mr-1"></i> Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
