<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Pengguna;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\StoreForumRequest;
use App\Http\Requests\UpdateForumRequest;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::with('pengguna')->get();
        $stats = [
            'pengguna' => Pengguna::count(),
            'forums' => Forum::count(),
            'posts' => Post::count(),
            'comments' => Comment::count(),
        ];
        return view('forum.index', compact('forums', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nav = 'Buat Forum Baru';
        return view('forum.create', compact('nav'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreForumRequest $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
        ]);

        // Mengakses ID pengguna dari sesi manual
        $userId = session('user_id');

        // Membuat forum baru
        Forum::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'created_by' => $userId, // Menyimpan ID pengguna yang membuat forum
        ]);

        return redirect()->route('forum.index')->with('success', 'Forum berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        $forum->load('posts.user', 'posts.comments.user'); 
        return view('forum.show', compact('forum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $id)
    {
        $forum = Forum::findOrFail($id);
        return view('forum.edit', compact('forum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumRequest $request, Forum $id)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
        ]);

        $forum = Forum::findOrFail($id);
        $forum->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('forum.show', $forum->id)->with('success', 'Forum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->route('forum.index')->with('success', 'Forum berhasil dihapus!');
    }

}