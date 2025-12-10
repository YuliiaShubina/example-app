<x-app-layout>
    <h1>Edit comment</h1>

    <p>
        <a href="{{ route('habits.show', $comment->habit_id) }}">← Back to habit</a>
    </p>

    <form method="POST" action="{{ route('comments.update', $comment) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="body">Comment text</label><br>
            <textarea
                id="body"
                name="body"
                rows="4"
                style="width:100%;"
                required
            >{{ old('body', $comment->body) }}</textarea>

            @error('body')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-top:10px;">
            Save changes
        </button>
    </form>
</x-app-layout>
