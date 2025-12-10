<x-app-layout>
    <a href="{{ route('habits.index') }}">← Back to all habits</a>

    <h1>{{ $habit->goal }}</h1>

    @if ($habit->image_path)
    <img src="{{ asset('storage/'.$habit->image_path) }}" alt="Habit image" style="max-width:300px; margin-bottom:10px;">
@endif

    <ul>
        <li><strong>User:</strong> 
        <a href="{{ route('users.show', $habit->user) }}">
        {{ $habit->user->name }}
        </a>
    </li>
        <li><strong>Frequency:</strong> {{ $habit->frequency }}</li>
        <li><strong>Created:</strong> {{ $habit->created_at->diffForHumans() }}</li>
        <li><strong>Likes:</strong> {{ $likesCount }}</li>
    </ul>

    @can('update', $habit)
    <a href="{{ route('habits.edit', $habit) }}">Edit habit</a>
@endcan

@can('delete', $habit)
    <form method="POST" action="{{ route('habits.destroy', $habit) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button style="color:red;" onclick="return confirm('Delete this habit?')">
            Delete habit
        </button>
    </form>
@endcan

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

    <div id = "comments-list">
    @foreach ($habit->comments as $comment)
        <div style="border:1px solid #1c0f0fff; padding:10px; margin-bottom:10px;">
            <strong>
                <a href="{{ route('users.show', $comment->user) }}">
                {{ $comment->user->name }}
                </a>
            </strong>
            <span style="font-size:12px; color:#555;">
                ({{ $comment->created_at->diffForHumans() }})
            </span>
            <p>{{ $comment->body }}</p>

            @can('update', $comment)
            <a href="{{ route('comments.edit', $comment) }}">Edit</a>
            @endcan

            @can('delete', $comment)
                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                    @csrf
                    @method('DELETE')
                    <button style="color:red;">Delete</button>
                </form>
            @endcan
        </div>
    @endforeach
</div>
    @auth
        <h3>Add a comment</h3>

        <div id="comment-error" style="color:red; margin-bottom:5px;"></div>

        <form method="POST" action="{{ route('habits.comments.store', $habit) }}">
            @csrf
            <textarea name="body" rows="3" style="width:100%;" required></textarea>
            <br>
            <button type="submit">Post Comment</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> to comment.</p>
    @endauth

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('comment-form');
    const commentsList = document.getElementById('comments-list');
    const errorBox = document.getElementById('comment-error');

    if (!form || !commentsList) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (errorBox) {
            errorBox.textContent = '';
        }

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',  // AJAX 
                },
                body: formData,
            });

            if (!response.ok) {
                
                const data = await response.json().catch(() => ({}));
                if (data.errors && data.errors.body) {
                    errorBox.textContent = data.errors.body[0];
                } else {
                    errorBox.textContent = 'Something went wrong. Please try again.';
                }
                return;
            }

            const data = await response.json();

            
            const newCommentHtml = `
                <div style="border:1px solid #1c0f0fff; padding:10px; margin-bottom:10px;">
                    <strong>${data.user_name}</strong>
                    <span style="font-size:12px; color:#555;">
                        (${data.created_human})
                    </span>
                    <p>${data.body}</p>
                </div>
            `;

            
            commentsList.insertAdjacentHTML('afterbegin', newCommentHtml);

            
            form.reset();
        } catch (err) {
            console.error(err);
            if (errorBox) {
                errorBox.textContent = 'Network error. Please try again.';
            }
        }
    });
});
</script>

</x-app-layout>
