<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-6 px-8">
        <form action="{{ route('events.store') }}" method="POST" class="max-w-lg bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-2">Start Date</label>
                <input type="date" name="starts_at" value="{{ old('starts_at') }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-2">End Date (optional)</label>
                <input type="date" name="ends_at" value="{{ old('ends_at') }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Save Event
            </button>
        </form>
    </div>
</x-app-layout>
