<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home() {
        $posts = Post::where('active', TRUE)->get();
        return view('homepage', compact('posts'));
    }

    
    public function postdetail(String $slug) {
        $post = Post::findBySlugOrFail($slug);
        return view('post-detail', compact('post'));
    }
}
