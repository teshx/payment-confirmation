<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Create
    public function create(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return response()->json(['message' => 'Post created successfully'], 201);
    }

    // Read
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Update
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return response()->json(['message' => 'Post updated successfully']);
    }

    // Delete
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
