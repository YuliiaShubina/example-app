<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create a New Habit
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4">

            <div class="bg-white border rounded-xl shadow-sm p-6">

                <h1 class="text-xl font-semibold text-gray-900 mb-4">
                    Create a new habit
                </h1>

                <form method="POST" action="{{ route('habits.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="goal" class="block text-sm font-medium text-gray-700">
                            Goal
                        </label>

                        <input
                            type="text"
                            id="goal"
                            name="goal"
                            value="{{ old('goal') }}"
                            required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >

                        @error('goal')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            Image (optional)
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer
                                   focus:border-emerald-500 focus:ring-emerald-500 file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0 file:text-sm file:font-medium
                                   file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                        >

                        @error('image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="frequency" class="block text-sm font-medium text-gray-700">
                            Frequency
                        </label>

                        <input
                            type="text"
                            id="frequency"
                            name="frequency"
                            value="{{ old('frequency') }}"
                            required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >

                        @error('frequency')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white text-sm font-medium rounded-md
                                   shadow-sm hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            Create Habit
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</x-app-layout>
