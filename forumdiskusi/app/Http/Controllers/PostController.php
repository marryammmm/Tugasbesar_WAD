<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Forum;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        $nav = 'Post';

        return view('post.index', compact('posts', 'nav'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($forumId)
    {
        $nav = 'Buat Diskusi Baru';
        $forum = Forum::findOrFail($forumId);
        return view('post.create', compact('forum', 'nav'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, $forumId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        $userId = session('user_id');

        Post::create([
            'content' => $request->content,
            'forum_id' => $forumId,
            'pengguna_id' => $userId
        ]);

        return redirect()->route('forum.show', $forumId)->with('success', 'Postingan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'content' => $request->content,
        ]);

        return redirect()->route('post.show', $post->id)->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('forum.index')->with('success', 'Postingan berhasil dihapus!');
    }
}
