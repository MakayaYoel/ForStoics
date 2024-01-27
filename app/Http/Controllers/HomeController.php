<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    // Redirects to the home page
    public function home(Request $request) {
        return view('homepage');
    }

    // Redirects to the search view
    public function search(Request $request) {
        $result = $this->searchUsersAndPosts();

        $users = $result[0];
        $posts = $result[1];

        return view('search', [
            'users' => $users,
            'posts' => $posts
        ]);
    }

    // Searches for users and posts that might find the search tag
    public function searchUsersAndPosts() : Collection {
        $users = DB::table('users')->where('name', 'like', '%' . request('search') . '%')->get();
        $posts = DB::table('posts')->where('title', 'like', '%' . request('search') . '%')->get();

        return collect([$users, $posts]);
    }
}
