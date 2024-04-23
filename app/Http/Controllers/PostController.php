<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Meta;
use Illuminate\Support\Facades\File;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = (new Post())->get_post_list();
        return view('modules.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post();
        return view('modules.post.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try{
            $post = (new Post())->storePost($request);
            (new Meta())->store_meta($request, $post);
            return redirect()->route('post.index')->with('success','Post created successfully');
        }catch(Throwable $throwable){

        }
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
        return view('modules.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        try{
            (new Post())->update_post($request, $post);
            (new Meta())->update_meta($request, $post);
            return redirect()->route('post.index')->with('success','Post updated successfully');
        }catch(Throwable $throwable){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        (new Post())->delete_post($post);
        return redirect()->route('post.index')->with('success','Post deleted successfully');
    }
}
