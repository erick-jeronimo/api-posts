<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Jobs\Likes\AddLikeOnPostJob;
use App\Models\Post;

class LikePostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, LikeRequest $request)
    {
        $input = $request->safe()->only(['user_id']);

        AddLikeOnPostJob::dispatch($post, $input['user_id']);

        return response()->json([
            'message' => 'Processing like on post'
        ], 201);
    }
}
