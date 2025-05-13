<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // In the index method
    public function index()
    {
        $tags = Tag::where('is_default', true)
            ->orWhere('user_id', Auth::id())
            ->get();

        return view('tags.index', compact('tags'));
    }

    // In the create method
    public function create()
    {
        return view('tags.create');
    }

    // In the store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = Auth::user()->tags()->create([
            'name' => $validated['name'],
            'is_default' => false,
        ]);

        // Check if the request has a 'redirect_to' parameter
        if ($request->has('redirect_to') && $request->redirect_to === 'create_task') {
            return redirect()->route('tasks.create')
                ->with('success', 'Tag created successfully.');
        }

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        if (!$tag->is_default && $tag->user_id !== Auth::id()) {
            abort(403);
        }

        $tasks = $tag->tasks()->where('user_id', Auth::id())->get();
        return view('tags.show', compact('tag', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        if (!$tag->is_default && $tag->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        if (!$tag->is_default && $tag->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->update($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if ($tag->is_default) {
            return redirect()->route('tags.index')
                ->with('error', 'Default tags cannot be deleted.');
        }

        if ($tag->user_id !== Auth::id()) {
            abort(403);
        }

        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully.');
    }
}
