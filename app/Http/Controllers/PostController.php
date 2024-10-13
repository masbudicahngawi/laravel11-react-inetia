<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use function Termwind\render;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }


    public function create()
    {
        return Inertia::render('Posts/Create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return Redirect::route('posts.index')->with('success', 'Post terbaru berhasil direkam.');
    }


    public function show(Post $post, string $id)
    {
        return Inertia::render('Post/Show', ['post' => $post]);
    }


    public function edit(Post $post, string $id)
    {
        return Inertia::render('Posts/Edit', ['post' => $post]);
    }

    
    public function update(Request $request, Post $post, string $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
 
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
 
        return Redirect::route('posts.index')->with('success', 'Post updated successfully.');
    }

   
    public function destroy(Post $post, string $id)
    {
        $post->delete();
        return Redirect::route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
