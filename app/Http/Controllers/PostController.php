<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate(9)
        ]);
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
        // Check whether the user has posted more than 3 posts in the past 24 hours
        if(count(
                $request->user()->posts->where('created_at', '>=', Carbon::now()->subDays(1)->toDateTimeString())
        ) + 1 > 3) {
            return back()->with('flash-message', 'You can only post 3 posts every 24 hours.');
        }

        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:24'],
            'content' => ['required', 'min:5', 'max:3000'],
            'cover_image' => ['mimes:jpeg,png', 'max:5120'] // Only accept images that are JPEGs or PNGs and <= 5MB
        ]);

        // Check if a cover image has been uploaded, then store it
        if($request->hasFile('cover_image')){
            $data['cover_image'] = $request->file('cover_image')->store('blog_covers', 'public');
        }

        $user = $request->user();

        $data['user_id'] = $user->id;

        // Add 100xp to the user's account for creating a post.
        $user->xp = $user->xp + 100;
        $user->save();

        $post = Post::create($data);

        return redirect("/posts/{$post->id}")->with('flash-message', 'Created post (+100 XP).');
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
            'content' => ['required', 'min:5', 'max:3000'],
            'cover_image' => ['mimes:jpeg,png', 'max:5120']
        ]);

        if($post->cover_image){
            Storage::disk('public')->delete($post->cover_image);
        }

        $data['cover_image'] = $request->hasFile('cover_image') ? $request->file('cover_image')->store('blog_covers', 'public') : null;

        $post->update($data);

        return redirect("/posts/{$post->id}")->with('flash-message', 'Successfully updated post!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post){
        $post->delete();

        return redirect('/')->with('flash-message', 'Successfully deleted post!');
    }

    // Attempt a like (or unlike) from a user
    public function attemptLike(Request $request, Post $post) {
        /** @var User $user */
        $user = auth()->user();

        $liked = false;

        if(!$user->hasLiked($post)) {
            $user->like($post);
            $liked = true;
        } else {
            $user->unlike($post);
        }

        return redirect()->back()->with('flash-message', ($liked ? 'Successfully Liked Post!' : 'Successfully Unliked Post!'));
    }

    // Submits a report
    public function reportPost(Request $request, Post $post) {
        $data = $request->validate([
            'additional_comment' => ['max:100']
        ]);
        
        $report_type = $request->get('report_type');

        $user = $request->user();

        // Checks whether the user has already reported the post
        if(count(DB::table('reports')->where('user_id', '=', $user->id)->where('post_id', '=', $post->id)->get()) >= 1){
            return back()->with('flash-message', 'You already reported this post.');
        }

        // Insertds the report data
        DB::table('reports')->insert([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'report_type' => (int)$report_type,
            'additional_comment' => $data['additional_comment'] ?? ""
        ]);

        // Add 50xp to the user's account for reporting a post.
        $user->xp = $user->xp + 50;
        $user->save();

        return back()->with('flash-message', 'Successfully Reported Post! (+50 XP)');
    }
}
