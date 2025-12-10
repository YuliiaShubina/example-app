<x-app-layout>
    <h1>Create a new habit</h1>

    <form method="POST" action="{{ route('habits.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom:10px;">
            <label for="goal">Goal</label><br>
            <input
                type="text"
                id="goal"
                name="goal"
                value="{{ old('goal') }}"
                style="width:100%;"
                required
            >
            @error('goal')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top:10px;">
    <label for="image">Image (optional)</label><br>
    <input type="file" id="image" name="image" accept="image/*">
    @error('image')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

        <div style="margin-bottom:10px;">
            <label for="frequency">Frequency</label><br>
            <input
                type="text"
                id="frequency"
                name="frequency"
                value="{{ old('frequency') }}"
                style="width:100%;"
                required
            >
            @error('frequency')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">
            Create habit
        </button>
    </form>
</x-app-layout>
