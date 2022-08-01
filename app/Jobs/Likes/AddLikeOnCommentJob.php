<?php

namespace App\Jobs\Likes;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddLikeOnCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Comment $comment;
    private int $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, int $user_id)
    {
        $this->comment = $comment;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment->likes()->create(['user_id' => $this->user_id]);
    }
}
