<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $anonymous = $this->faker->boolean();
        return [
            'body' => $this->faker->paragraphs(3, true),
            'anonymous' => $anonymous,
            'post_id' => function () {
                return Post::factory()->create()->id;
            },
            'user_id' => $anonymous
                ? null
                : function () {
                    return User::factory()->create()->id;
                },
        ];
    }
}
