<x-app-layout>
    <h1>All Habits</h1>

    @if($habits->count() === 0)
        <p>No habits found.</p>
    @else
        <ul>
            @foreach ($habits as $habit)
                <li style="margin-bottom:15px; border-bottom:1px solid #ccc; padding-bottom:10px;">
                    <a href="{{ route('habits.show', $habit) }}">
                        <strong>{{ $habit->goal }}</strong>
                    </a>
                    <br>
                    User: {{ $habit->user->name }}
                    <br>
                    Frequency: {{ $habit->frequency }}
                    <br>
                    {{ $habit->comments_count }} comments,
                    {{ $habit->likes_count }} likes
                </li>
            @endforeach
        </ul>

        {{ $habits->links() }}
    @endif
</x-app-layout>
