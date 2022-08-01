<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'likeable_id' => 1,
            'likeable_type' => 'App\Models\Post',
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
