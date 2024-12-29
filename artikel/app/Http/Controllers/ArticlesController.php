<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Ensure the Article model is imported
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function index_user()
    {
        $articles = Article::all();
        return view('user.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null; // No image uploaded
        }

        // Create the article
        Article::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'image_url' => $imagePath,
            'video_url' => $request->video_url,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show_user(Article $article)
    {
        return view('user.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'video_url' => 'nullable|url',
        ]);
        if ($request->hasFile('image')) {
            if ($article->image_url) {
                Storage::disk('public')->delete($article->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('images', 'public');
    }
    

        // Update the article
        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->image_url) {
            Storage::disk('public')->delete($article->image_url);
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
