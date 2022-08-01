<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_a_comment_on_a_post()
    {
        Post::factory()->create();

        $response = $this->post('/api/v1/posts/1/comments', [
            'body' => 'Teste de body de um post',
            'anonymous' => false,
            'user_id' => 1,
        ]);

        $response->assertStatus(201);
    }

    public function test_listing_all_comments_of_a_post()
    {
        Comment::factory(3)->create();

        $response = $this->get('/api/v1/posts/1/comments');

        $response->assertStatus(200);
    }

    public function test_show_a_specific_comment()
    {
        Comment::factory()->create();

        $response = $this->get('/api/v1/comments/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'body',
            'owner',
            'anonymous',
            'owner',
            'likes',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_udpate_a_comment()
    {
        Comment::factory()->create();

        $updatedComment = $this->put("/api/v1/comments/1", [
            'body' => 'Body do Comment Atualizado'
        ])->decodeResponseJson();

        $this->assertEquals(
            'Body do Comment Atualizado',
            $updatedComment['body'],
            "actual value is not equals to expected"
        );
    }

    public function test_delete_a_comment()
    {
        Comment::factory()->create();

        $response = $this->delete('/api/v1/comments/1');

        $response->assertStatus(200);
    }
}
