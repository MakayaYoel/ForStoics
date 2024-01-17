<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:24'],
            'content' => ['required', 'min:5', 'max:3000']
        ]);

        $user = $request->user();

        $data['user_id'] = $user->id;

        // Add 100xp to the user's account for creating a post.
        $user->xp = $user->xp + 100;
        $user->save();

        $post = Post::create($data);

        return redirect("/posts/{$post->id}")->with('flash-message', 'Created post.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post){
        // Stop user's from editing other's posts.
        if(auth()->user()->id !== $post->user->id) abort(403, 'Unauthorized Action');

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post){
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:24'],
            'content' => ['required', 'min:5', 'max:3000'] 
        ]);

        $post->update($data);

        return redirect("/posts/{$post->id}")->with('flash-message', 'Successfully updated post!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post){
        $post->delete();

        return redirect('/');
    }
}
