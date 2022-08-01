<?php

namespace App\Jobs\Comments;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Post $post;
    private array $commentInput;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, array $commentInput)
    {
        $this->post = $post;
        $this->commentInput = $commentInput;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = (new Comment)->fill($this->commentInput);

        $this->post->comments()->save($comment);
    }
}
