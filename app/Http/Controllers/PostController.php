<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Blog API",
 *      description="Blog API documentation",
 *      @OA\Contact(
 *          email="blogapi@example.com"
 *      )
 * )
 */
class PostController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/posts",
     *     operationId="getPostsList",
     *     tags={"Posts"},
     *     summary="Get list of posts",
     *     description="Returns list of posts",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Post")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

/**
     * @OA\Post(
     *     path="/api/posts",
     *     operationId="storePost",
     *     tags={"Posts"},
     *     summary="Store a new post",
     *     description="Creates a new post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
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
   /**
     * @OA\Get(
     *     path="/api/posts/{post}",
     *     operationId="getPostById",
     *     tags={"Posts"},
     *     summary="Get post information",
     *     description="Returns post data",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

 /**
     * @OA\Put(
     *     path="/api/posts/{post}",
     *     operationId="updatePost",
     *     tags={"Posts"},
     *     summary="Update existing post",
     *     description="Updates a post and returns the updated post",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
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

  /**
     * @OA\Delete(
     *     path="/api/posts/{post}",
     *     operationId="deletePost",
     *     tags={"Posts"},
     *     summary="Delete a post",
     *     description="Deletes a post and returns no content",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

      /**
     * @OA\Post(
     *     path="/api/posts/{post}/schedule",
     *     operationId="schedulePost",
     *     tags={"Posts"},
     *     summary="Schedule a post for future publication",
     *     description="Schedules a post to be published in the future",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="publish_at", type="string", format="date-time", description="The publish date of the post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function schedule(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'publish_at' => 'required|date|after:now',
        ]);

        $post->publish_at = $request->input('publish_at');
        $post->save();

        return new PostResource($post);
    }
}
