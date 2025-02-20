<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\File;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postQuery = Auth::id() == 1 ? Post::orderBy('created_at') : Post::where('user_id', Auth::id());
        $posts = $postQuery->get()->map(function ($data) {
            $btnEdit = '<a class="btn btn-xs btn-default text-primary mx-1 shadow" href="'. route('post.edit',$data->id) .'" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete = '<a class="btn btn-xs btn-default text-danger mx-1 shadow delete" Onclick="return ConfirmDelete();" href="'. route('post.delete',$data->id) .'" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </a>';
            $arr_data = [
                $data->title,
                $data->user->email,
                $data->status,
                $data->created_at->format('d/m/Y h:s'),
                $btnEdit.$btnDelete,
            ];
            return $arr_data;
        });
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all()->pluck('name', 'id');
        return view('post.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $param = $request->all();
        $param['user_id'] = Auth::id();
        $param['active'] = $param['active']?? FALSE;

        $file = $request->file('file_id');
        $fileName = $file->hashName();
        $request->file_id->move(public_path('images'), $fileName);

        $fid = File::create([
            'original_name' => 'images/'.$fileName,
            'generated_name' => $fileName
        ]);

        $param['file_id'] = $fid->id;

        Post::create($param);

        flash()->success('schedules registered');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all()->pluck('name', 'id');
        return view('post.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $param = $request->all();
        $param['active'] = $param['active']?? FALSE;
        // dd($param->file_id);
        if(!empty($request->file_id)) {
            $file = $request->file('file_id');
            $fileName = $file->hashName();
            $request->file_id->move(public_path('images'), $fileName);

            $fid = File::create([
                'original_name' => 'images/'.$fileName,
                'generated_name' => $fileName
            ]);
            // dd($fid->id);
            $param['file_id'] = $fid->id;
        }

        $post->update($param);

        flash()->success('post updated');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // dd($post->comments->count());
        foreach($post->comments as $comment) {
            $comment->replies()->delete();
        }
        $post->comments()->delete();
        $post->delete();
        flash()->warning('post deleted');
        return redirect()->route('post.index');
    }
}
