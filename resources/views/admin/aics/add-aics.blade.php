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
                {{ __('Add AICS') }}
            </h2>
            <a href="{{ route('admin.AICS') }}" class="bg-green-700 text-white px-3 py-2 rounded-lg">
                <span><i class="fas fa-angle-left"></i></span>
            </a>
        </div>
    </x-slot>

    <div class="m-5 p-5 bg-white shadow-md rounded-md">
        <form action="{{ route('AICS.store') }}" method="POST">
            @csrf

            <!-- Client -->
            <div class="mb-5">
                <x-input-label for="client_id" :value="__('Select Client')" />
                <select id="client_id" name="client_id"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Choose a client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->lname }}, {{ $client->fname }} {{ $client->mname }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
            </div>

            <!-- Principal Client -->
            <div class="mb-5">
                <x-input-label for="principal_client" :value="__('Principal Client')" />
                <x-text-input id="principal_client" class="block mt-1 w-full"
                              type="text" name="principal_client" :value="old('principal_client')" />
                <x-input-error :messages="$errors->get('principal_client')" class="mt-2" />
            </div>



            <!-- GIS -->
            <div class="mb-5">
                <x-input-label for="gis" :value="__('GIS')" />
                <select id="gis" name="gis"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select --</option>
                    <option value="Medical Assistance">Medical Assistance</option>
                    <option value="Burial Assistance">Burial Assistance</option>

                </select>
                <x-input-error :messages="$errors->get('gis')" class="mt-2" />
            </div>
            <!-- DIAGNOSIS -->
            <div class="mb-5">
                <x-input-label for="diagnosis" :value="__('Diagnosis')" />
                <x-text-input id="diagnosis" class="block mt-1 w-full"
                              type="text" name="diagnosis" :value="old('diagnosis')" />
                <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
            </div>




            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-md transition-all">
                    <i class="fas fa-save mr-1"></i> Submit
                </button>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        new TomSelect("#client_id", {
            create: false,
            sortField: { field: "text", direction: "asc" },
            placeholder: "Search client name...",
        });
    });
    
</script>
</x-app-layout>
