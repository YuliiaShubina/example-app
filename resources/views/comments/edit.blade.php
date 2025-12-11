<x-app-layout>

    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">
                Edit Comment
            </h2>

            <a href="{{ route('habits.show', $comment->habit_id) }}"
               class="text-sm text-emerald-600 hover:text-emerald-700">
                ← Back to Habit
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto px-4">

            
            <div class="bg-white border rounded-xl shadow-sm p-6">

                <h1 class="text-lg font-semibold text-gray-900 mb-4">
                    Edit your comment
                </h1>

                <form method="POST" action="{{ route('comments.update', $comment) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    
                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">
                            Comment text
                        </label>

                        <textarea
                            id="body"
                            name="body"
                            rows="4"
                            required
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm
                                   focus:border-emerald-500 focus:ring-emerald-500"
                        >{{ old('body', $comment->body) }}</textarea>

                        @error('body')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                   
                    <div class="flex items-center gap-3">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-emerald-500 text-white text-sm font-medium rounded-md
                                   shadow-sm hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            Save Changes
                        </button>

                        <a href="{{ route('habits.show', $comment->habit_id) }}"
                           class="text-sm text-gray-600 hover:text-gray-800">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>

</x-app-layout>
