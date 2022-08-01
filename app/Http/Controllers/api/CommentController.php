<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Jobs\Comments\AddCommentJob;
use App\Jobs\Comments\RemoveCommentJob;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    public function index(Post $post, Request $request)
    {
        $limit = $request->input('limit') ?? 10;

        return CommentResource::collection(
            Cache::remember(
                'comments',
                60 * 60 * 24,
                fn () => Comment::where('post_id', $post->id)->latest()->paginate($limit)
            )
        );
    }

    public function store(Post $post, CommentRequest $request)
    {
        AddCommentJob::dispatch($post, $request->validated());

        return response()->json([
            'message' => 'Processing comment to register on post'
        ], 201);
    }


    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }


    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return response()->json($comment);
    }


    public function destroy(Comment $comment)
    {
        RemoveCommentJob::dispatch($comment);

        return response()->json([
            'message' => 'Processing comment removal'
        ], 204);
    }
}
