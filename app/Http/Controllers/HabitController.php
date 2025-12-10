<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use Illuminate\Support\Facades\Storage;



class HabitController extends Controller
{
     public function index()
    {
        $habits = Habit::with('user')
            ->withCount('comments', 'likes')
            ->latest()
            ->paginate(10);

        return view('habits.index', compact('habits'));
    }

    public function show(Habit $habit)
    {
        $habit->load([
            'user',
            'comments.user',
            'likes',
        ]);

        $likesCount = $habit->likes->count();

        $likedByAuthUser = auth()->check()
            ? $habit->likes->contains('user_id', auth()->id())
            : false;

        return view('habits.show', [
            'habit'           => $habit,
            'likesCount'      => $likesCount,
            'likedByAuthUser' => $likedByAuthUser,
        ]);
    }

    public function edit(Habit $habit){
        $this->authorize('update', $habit);
        
        return view('habits.edit', compact('habit'));
    }

    public function update(Request $request, Habit $habit){
        $this->authorize('update', $habit);

        $data = $request->validate([
            'goal'      => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'frequency' => 'required|string|max:50',
        ]);

        if ($request->hasFile('image')) {

        if ($habit->image_path) {
            Storage::disk('public')->delete($habit->image_path);
        }

        $habit->image_path = $request->file('image')->store('habit_images', 'public');
    }

        $habit->goal = $data['goal'];
        $habit->frequency = $data['frequency'];

        $habit->update($data);

        $habit->save();

        return redirect()
            ->route('habits.show', $habit)
            ->with('success', 'Habit updated.');
    }

    public function destroy(Habit $habit)
    {
        $this->authorize('delete', $habit);

        $habit->delete();

        return redirect()
            ->route('habits.index')
            ->with('success', 'Habit deleted.');
    }

    public function create(){
        return view('habits.create');
    }

    public function store(Request $request){
         $data = $request->validate([
            'goal'      => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'frequency' => 'required|string|max:50',
        ]);

         $imagePath = null;

            if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('habit_images', 'public');
            }

        Habit::create([
            'goal'      => $data['goal'],
            'frequency' => $data['frequency'],
            'archived'  => false,
            'user_id'   => auth()->id(),
            'image_path' => $imagePath,
        ]);

        return redirect()
            ->route('habits.index')
            ->with('success', 'Habit created.');
    }
}
