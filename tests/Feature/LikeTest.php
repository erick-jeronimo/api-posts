<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_like_on_a_post()
    {
        $user = User::factory()->create();
        Post::factory()->create();

        $response = $this->post('api/v1/posts/1/likes/', [
            'user_id' => $user->id
        ]);

        $jsonResponse = $response->decodeResponseJson();

        $response->assertStatus(201);
        $this->assertEquals(
            'Processing like on post',
            $jsonResponse['message'],
            "actual value is not equals to expected"
        );
    }

    public function test_like_on_a_comment()
    {
        $user = User::factory()->create();
        Comment::factory()->create();

        $response = $this->post('api/v1/comments/1/likes/', [
            'user_id' => $user->id
        ]);

        $response->assertStatus(201);

        $jsonResponse = $response->decodeResponseJson();

        $this->assertEquals(
            'Processing like on comment',
            $jsonResponse['message'],
            "actual value is not equals to expected"
        );
    }

    public function test_remove_like()
    {
        Like::factory()->create();

        $response = $this->delete('/api/v1/likes/1');

        $response->assertStatus(200);
    }
}
