<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Jobs\Likes\AddLikeOnCommentJob;
use App\Models\Comment;

class LikeCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Comment $comment, LikeRequest $request)
    {
        $input = $request->safe()->only(['user_id']);

        AddLikeOnCommentJob::dispatch($comment, $input['user_id']);

        return response()->json([
            'message' => 'Processing like on comment'
        ], 201);
    }
}
