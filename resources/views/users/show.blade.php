<x-app-layout>
    <h1>User: {{ $user->name }}</h1>

    <hr>

    <h2>All habits by {{ $user->name }}</h2>

    @foreach ($habits as $habit)
        <div style="margin-bottom:15px;">
            <a href="{{ route('habits.show', $habit) }}">
                <strong>{{ $habit->goal }}</strong>
            </a>
            <p>Frequency: {{ $habit->frequency }}</p>
            <p>Created: {{ $habit->created_at->diffForHumans() }}</p>
        </div>
        <hr>
    @endforeach

    {{ $habits->links() }}

    <h2>Comments by {{ $user->name }}</h2>

    @foreach ($comments as $comment)
        <p>
            "{{ $comment->body }}" on
            <a href="{{ route('habits.show', $comment->habit) }}">
                {{ $comment->habit->goal }}
            </a>
            ({{ $comment->created_at->diffForHumans() }})
        </p>
        <hr>
    @endforeach
</x-app-layout>
