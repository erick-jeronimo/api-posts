<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_post()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/v1/posts', [
            'title' => 'Testando a criação de um post',
            'body' => 'Teste de body de um post',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_listing_all_posts()
    {
        Post::factory(3)->create();

        $response = $this->get('/api/v1/posts');

        $response->assertStatus(200);
    }

    public function test_show_a_specific_post()
    {
        Post::factory()->create();

        $response = $this->get('/api/v1/posts/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'body',
            'owner',
            'comments',
            'likes',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_udpate_a_post()
    {
        Post::factory()->create();

        $updatedPost = $this->put("/api/v1/posts/1", [
            'title' => 'Titulo do Post Atualizado'
        ])->decodeResponseJson();

        $this->assertEquals(
            'Titulo do Post Atualizado',
            $updatedPost['title'],
            "actual value is not equals to expected"
        );
    }

    public function test_delete_a_post()
    {
        Post::factory()->create();

        $response = $this->delete('/api/v1/posts/1');

        $response->assertStatus(200);
    }
}
