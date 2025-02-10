<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home(Request $request) {
        $param = $request->all();
        $postsQuery = Post::where('active', TRUE);
        if(!empty($param['search'])) {
            $postsQuery->where('title', 'LIKE', '%'.$param['search'].'%');
        }
        if($param['order'] == 'oldest') {
            $postsQuery->orderBy('created_at', 'asc');
        }
        else {
            $postsQuery->orderBy('created_at', 'desc');
        }
        $posts = $postsQuery->get();
        return view('homepage', compact('posts', 'param'));
    }

    
    public function postdetail(String $slug) {
        $post = Post::findBySlugOrFail($slug);
        return view('post-detail', compact('post'));
    }
}
