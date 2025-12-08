<x-app-layout>
    <a href="{{ route('habits.index') }}">← Back to all habits</a>

    <h1>{{ $habit->goal }}</h1>

    <ul>
        <li><strong>User:</strong> {{ $habit->user->name }}</li>
        <li><strong>Frequency:</strong> {{ $habit->frequency }}</li>
        <li><strong>Created:</strong> {{ $habit->created_at->diffForHumans() }}</li>
        <li><strong>Likes:</strong> {{ $likesCount }}</li>
    </ul>

    @auth
        <form action="{{ route('habits.like', $habit) }}" method="POST">
            @csrf
            <button>
                {{ $likedByAuthUser ? 'Unlike' : 'Like' }}
            </button>
        </form>
    @endauth

    <hr>

    <h2>Comments ({{ $habit->comments->count() }})</h2>

    @foreach ($habit->comments as $comment)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>{{ $comment->user->name }}</strong>
            <span style="font-size:12px; color:#555;">
                ({{ $comment->created_at->diffForHumans() }})
            </span>
            <p>{{ $comment->body }}</p>

            @can('delete', $comment)
                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                    @csrf
                    @method('DELETE')
                    <button style="color:red;">Delete</button>
                </form>
            @endcan
        </div>
    @endforeach

    @auth
        <h3>Add a comment</h3>
        <form method="POST" action="{{ route('habits.comments.store', $habit) }}">
            @csrf
            <textarea name="body" rows="3" style="width:100%;" required></textarea>
            <br>
            <button type="submit">Post Comment</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> to comment.</p>
    @endauth
</x-app-layout>
