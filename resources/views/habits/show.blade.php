<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('habits.index') }}" class="text-emerald-600 hover:text-emerald-700 text-sm">
                Back to all habits
            </a>

            <h2 class="font-semibold text-xl text-gray-800">
                Habit Details
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">

            
            <div class="bg-white border rounded-xl shadow-sm p-6 space-y-6">

                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">
                            {{ $habit->goal }}
                        </h1>

                        <p class="text-sm text-gray-600 mt-1">
                            With 
                            <a href="{{ route('users.show', $habit->user) }}"
                               class="text-emerald-600 hover:text-emerald-700 font-medium">
                                {{ $habit->user->name }}
                            </a>
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Created {{ $habit->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- LIKE BUTTON --}}
                    @auth
                        <form
                            action="{{ route('habits.like', $habit) }}"
                            method="POST"
                        >
                            @csrf
                            <button class="px-3 py-1 text-sm rounded-md border border-gray-300
                                           hover:border-emerald-400 hover:text-emerald-600">
                                {{ $likedByAuthUser ? 'Unlike' : 'Like' }}
                            </button>
                        </form>
                    @endauth
                </div>

                @if ($habit->image_path)
                    <img src="{{ asset('storage/' . $habit->image_path) }}"
                         alt="Habit image"
                         class="w-64 rounded-lg border shadow-sm">
                @endif

                <ul class="space-y-1 text-sm text-gray-700">
                    <li><strong>User:</strong>
                        <a href="{{ route('users.show', $habit->user) }}"
                           class="text-emerald-600 hover:text-emerald-700">
                           {{ $habit->user->name }}
                        </a>
                    </li>

                    <li><strong>Frequency:</strong> {{ $habit->frequency }}</li>
                    <li><strong>Likes:</strong> {{ $likesCount }}</li>
                </ul>

                
                <div class="flex gap-3 pt-3">
                    @can('update', $habit)
                        <a href="{{ route('habits.edit', $habit) }}"
                           class="px-3 py-1 bg-gray-100 text-sm rounded-md hover:bg-gray-200">
                            Edit Habit
                        </a>
                    @endcan

                    @can('delete', $habit)
                        <form method="POST" action="{{ route('habits.destroy', $habit) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                onclick="return confirm('Delete this habit?')"
                                class="px-3 py-1 text-sm rounded-md bg-red-500 text-white hover:bg-red-600">
                                Delete Habit
                            </button>
                        </form>
                    @endcan
                </div>

            </div>

            <div class="bg-white border rounded-xl shadow-sm p-6 mt-8">

                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Comments
                </h2>

                <div id="comments-list" class="space-y-4">
                    @foreach ($habit->comments as $comment)
                        <div class="rounded-lg border border-gray-200 p-4 bg-gray-50">
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ route('users.show', $comment->user) }}"
                                       class="font-semibold text-gray-800 hover:text-emerald-600">
                                        {{ $comment->user->name }}
                                    </a>
                                    <span class="text-xs text-gray-500">
                                        • {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <div class="flex gap-2 text-xs">

                                    @can('update', $comment)
                                        <a href="{{ route('comments.edit', $comment) }}"
                                           class="text-emerald-600 hover:text-emerald-700">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $comment)
                                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                            </div>

                            <p class="text-gray-700 mt-2">{{ $comment->body }}</p>
                        </div>
                    @endforeach
                </div>

                @auth
                    <h3 class="text-md font-semibold text-gray-800 mt-6">Add a Comment</h3>

                    <div id="comment-error" class="text-red-600 text-sm mb-2"></div>

                    <form method="POST" action="{{ route('habits.comments.store', $habit) }}" id="comment-form">
                        @csrf

                        <textarea
                            name="body"
                            rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm mt-2
                                   focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        ></textarea>

                        <button
                            type="submit"
                            class="mt-2 px-4 py-2 bg-emerald-500 text-white text-sm rounded-md hover:bg-emerald-600">
                            Post Comment
                        </button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 mt-4">
                        <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700">
                            Login
                        </a> to comment.
                    </p>
                @endauth

            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('comment-form');
        const commentsList = document.getElementById('comments-list');
        const errorBox = document.getElementById('comment-error');

        if (!form || !commentsList) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            errorBox.textContent = '';

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (!response.ok) {
                    const data = await response.json().catch(() => ({}));
                    errorBox.textContent = data.errors?.body?.[0] || 'Something went wrong.';
                    return;
                }

                const data = await response.json();

                const newCommentHtml = `
                    <div class="rounded-lg border border-gray-200 p-4 bg-gray-50">
                        <div class="flex justify-between">
                            <div>
                                <span class="font-semibold text-gray-800">${data.user_name}</span>
                                <span class="text-xs text-gray-500">• ${data.created_human}</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mt-2">${data.body}</p>
                    </div>
                `;

                commentsList.insertAdjacentHTML('afterbegin', newCommentHtml);
                form.reset();

            } catch (err) {
                errorBox.textContent = 'Network error, please try again.';
            }
        });
    });
    </script>

</x-app-layout>
