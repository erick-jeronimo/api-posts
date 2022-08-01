<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit') ?? 10;

        return PostResource::collection(
            Cache::remember(
                'posts',
                60 * 60 * 24,
                fn () => Post::latest()->paginate($limit)
            )
        );
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->safe()->except(['user_id']));

        return new PostResource($post);
    }


    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json($post);
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post succesfuly removed'
        ], 204);
    }
}
