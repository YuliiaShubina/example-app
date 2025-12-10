<x-app-layout>
    <h1>All Habits</h1>


    @auth
        <p>
            <a href="{{ route('habits.create') }}">+ Create a new habit</a>
        </p>
    @endauth

    @if($habits->count() === 0)
        <p>No habits found.</p>
    @else
        <ul>
            @foreach ($habits as $habit)
                <li style="margin-bottom:15px; border-bottom:1px solid #ccc; padding-bottom:10px;">
                    <a href="{{ route('habits.show', $habit) }}">
                        <strong>{{ $habit->goal }}</strong>
                    </a>
                    @if ($habit->image_path)
                        <img src="{{ asset('storage/'.$habit->image_path) }}" alt="Habit image" style="max-width:150px; display:block; margin-bottom:5px;">
                    @endif
                    <br>
                    User: <a href="{{ route('users.show', $habit->user) }}">
                        {{ $habit->user->name }}
                    </a>

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
