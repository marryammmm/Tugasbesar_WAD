<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        $userId = session('user_id');

        // Create the comment
        Comment::create([
            'content' => $request->content,
            'post_id' => $postId,
            'pengguna_id' =>  $userId, // Ensure to use 'auth()->user()->id'
        ]);

        // Redirect to the post page with a success message
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Cari komentar berdasarkan ID
        $comment = Comment::findOrFail($id);
        
        // Update comment
        $comment->update([
            'content' => $request->content,
        ]);

        // Redirect ke halaman post dengan pesan sukses
        return redirect()->back()->with('success', 'Komentar berhasil diperbarui!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        // Redirect ke halaman post dengan pesan sukses
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    
    }
}
