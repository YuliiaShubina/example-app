<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Notifications
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white border rounded-xl shadow-sm divide-y">

                @forelse ($notifications as $notification)
                    @php $data = $notification->data; @endphp

                    <div class="p-4 flex justify-between items-start {{ $notification->read_at ? 'bg-white' : 'bg-emerald-50' }}">
                        <div>
                            <p class="text-sm text-gray-800">
                                <span class="font-semibold">{{ $data['actor_name'] ?? 'Someone' }}</span>
                                @if(($data['type'] ?? null) === 'comment')
                                    commented on your habit
                                @elseif(($data['type'] ?? null) === 'like')
                                    liked your habit
                                @else
                                    interacted with your habit
                                @endif

                                <span class="font-semibold">
                                    "{{ $data['habit_goal'] ?? '' }}"
                                </span>
                            </p>

                            @if (!empty($data['comment_body']))
                                <p class="text-xs text-gray-600 mt-1">
                                    “{{ Str::limit($data['comment_body'], 80) }}”
                                </p>
                            @endif

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button class="text-xs text-emerald-600 hover:text-emerald-700">
                                View
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="p-6 text-sm text-gray-500">
                        No notifications yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
