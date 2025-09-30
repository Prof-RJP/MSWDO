<x-app-layout>
    <x-slot name="header" class="shadow-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-full">
        <div class="flex flex-col justify-center items-center h-full relative">
                <img src="{{ asset('images/logo.jpg') }}" class="h-96 rounded-full object-fill opacity-30" alt="">
                <div class="text-center absolute text-gray-600">
                    <h1 class="text-7xl font-bold font-serif">WELCOME!</h1>
                    <h1 class="text-2xl">Municipal Social Welfare and Development Office</h1>
                </div>
        </div>
    </div>
</x-app-layout>
