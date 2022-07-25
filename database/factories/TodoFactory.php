<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tag;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */protected $model = Todo::class;

/**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_tag_id = Tag::first()->id;
        $last_tag_id = Tag::all()->last()->id;
        $first_user_id = User::first()->id;
        $last_user_id = User::all()->last()->id;

        return [
            'tag_id' => rand($first_tag_id, $first_tag_id),
            'user_id' => rand($first_user_id, $first_user_id),
            'content' => $this->faker->word
        ];
    }
}
