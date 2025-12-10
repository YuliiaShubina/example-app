<x-app-layout>
    <h1>Edit habit</h1>

    <form method="POST" action="{{ route('habits.update', $habit) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Goal</label><br>
            <input type="text" name="goal" value="{{ old('goal', $habit->goal) }}" style="width:100%;">
            @error('goal')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

            <div style="margin-top:10px;">
        <label for="image">Change image (optional)</label><br>
        @if ($habit->image_path)
            <div style="margin-bottom:5px;">
                <img src="{{ asset('storage/'.$habit->image_path) }}" alt="Habit image" style="max-width:200px;">
            </div>
        @endif
        <input type="file" id="image" name="image" accept="image/*">
        @error('image')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
        <div style="margin-top:10px;">
            <label>Frequency</label><br>
            <input type="text" name="frequency" value="{{ old('frequency', $habit->frequency) }}" style="width:100%;">
            @error('frequency')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-top:10px;">Save changes</button>
    </form>
</x-app-layout>
