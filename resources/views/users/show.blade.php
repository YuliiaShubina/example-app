<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('habits.index') }}"
               class="text-sm text-emerald-600 hover:text-emerald-700">
                Back to all habits
                </a>

                <h2 class="font-semibold text-xl text-gray-800">
                    {{ $user->name }}
                </h2>
                <p class="text-sm text-gray-500">
                    User profile Habits & comments
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 space-y-8">

           
            <div class="bg-white border rounded-xl shadow-sm p-6">
                <h1 class="text-xl font-semibold text-gray-900">
                    {{ $user->name }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Member since {{ $user->created_at->format('M Y') }}
                </p>

                <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-600">
                    <span>
                        <span class="font-semibold">{{ $habits->total() }}</span> habits
                    </span>
                    <span>
                        <span class="font-semibold">{{ $comments->count() }}</span> comments
                    </span>
                </div>
            </div>

            
            <div class="bg-white border rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Habits by {{ $user->name }}
                </h2>

                @if ($habits->count() === 0)
                    <p class="text-sm text-gray-500">
                        No habits yet.
                    </p>
                @else
                    <div class="space-y-4">
                        @foreach ($habits as $habit)
                            <div class="border border-gray-100 rounded-lg p-4 hover:bg-gray-50 transition">
                                <a href="{{ route('habits.show', $habit) }}"
                                   class="text-base font-semibold text-gray-900 hover:text-emerald-600">
                                    {{ $habit->goal }}
                                </a>

                                <p class="text-sm text-gray-500 mt-1">
                                    Frequency: <span class="text-gray-700">{{ $habit->frequency }}</span>
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Created {{ $habit->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $habits->links() }}
                    </div>
                @endif
            </div>

            
            <div class="bg-white border rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Comments by {{ $user->name }}
                </h2>

                @if ($comments->count() === 0)
                    <p class="text-sm text-gray-500">
                        No comments yet.
                    </p>
                @else
                    <div class="space-y-3">
                        @foreach ($comments as $comment)
                            <div class="border border-gray-100 rounded-lg p-3 bg-gray-50">
                                <p class="text-sm text-gray-800">
                                    “{{ $comment->body }}”
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    on
                                    <a href="{{ route('habits.show', $comment->habit) }}"
                                       class="text-emerald-600 hover:text-emerald-700">
                                        {{ $comment->habit->goal }}
                                    </a>
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
