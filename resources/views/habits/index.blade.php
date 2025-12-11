<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                All Habits
            </h2>

            @auth
                <a href="{{ route('habits.create') }}"
                   class="px-3 py-2 bg-emerald-500 text-white rounded-md text-sm font-medium hover:bg-emerald-600">
                    + Create Habit
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            @if($habits->count() === 0)
                <div class="bg-white shadow-sm border rounded-lg p-6 text-center text-gray-500">
                    No habits found.
                </div>
            @else

                <div class="space-y-4">
                    @foreach ($habits as $habit)
                        <div class="bg-white border rounded-lg shadow-sm p-4">
                            
                            <div class="flex justify-between items-start">
                                <div>
                                    <a href="{{ route('habits.show', $habit) }}"
                                       class="text-lg font-semibold text-gray-900 hover:text-emerald-600">
                                        {{ $habit->goal }}
                                    </a>

                                    <p class="text-sm text-gray-500 mt-1">
                                        By 
                                        <a href="{{ route('users.show', $habit->user) }}" 
                                           class="text-gray-700 hover:text-emerald-600">
                                           {{ $habit->user->name }}
                                        </a>
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        Frequency: {{ $habit->frequency }}
                                    </p>
                                </div>

                                {{-- Streak / Created At --}}
                                <div class="text-xs text-gray-500">
                                    {{ $habit->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @if ($habit->image_path)
                                <img src="{{ asset('storage/'.$habit->image_path) }}"
                                     class="mt-3 w-40 rounded-md border"
                                     alt="Habit image">
                            @endif

                            <div class="flex items-center gap-4 text-sm text-gray-600 mt-3">
                                <span>{{ $habit->comments_count }} comments</span>
                                <span>•</span>
                                <span>{{ $habit->likes_count }} likes</span>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $habits->links() }}
                </div>

            @endif

        </div>
    </div>
</x-app-layout>
