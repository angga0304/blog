<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all()->map(function ($data) {
            $btnEdit = '<a class="btn btn-xs btn-default text-primary mx-1 shadow" href="'. route('tag.edit',$data->id) .'" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete = '<a class="btn btn-xs btn-default text-danger mx-1 shadow delete" Onclick="return ConfirmDelete();" href="'. route('tag.delete',$data->id) .'" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </a>';
            $arr_data = [
                $data->name,
                $data->posts->count(),
                $btnEdit.$btnDelete,
            ];
            return $arr_data;
        });
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $param = $request->all();
        Tag::create($param);

        flash()->success('tag created');
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $param = $request->all();
        $param['active'] = $param['active']?? FALSE;
        $tag->update($param);

        flash()->success('tag updated');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        flash()->warning('tag dihapus');
        return redirect()->route('tag.index');
    }
}
