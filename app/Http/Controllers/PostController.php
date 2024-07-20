<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Http\Response;

class PostController extends Controller
{

    public function index()
    {
        return PostResource::collection(Post::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'publish_at' => 'nullable|date|after:now',
        ]);

        $post = Post::create($request->all());
        return new PostResource($post);
    }


    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'author' => 'sometimes|required|string|max:255',
            'publish_at' => 'nullable|date|after:now',
        ]);

        $post->update($request->all());
        return new PostResource($post);
    }


    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
