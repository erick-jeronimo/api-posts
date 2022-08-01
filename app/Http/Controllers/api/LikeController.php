<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\Likes\RemoveLikeJob;
use App\Models\Like;

class LikeController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        RemoveLikeJob::dispatch($like);

        return response()->json([
            'message' => 'Processing like removal on comment'
        ], 204);
    }
}
