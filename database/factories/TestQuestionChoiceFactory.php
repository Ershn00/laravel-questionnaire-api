<?php

namespace Database\Factories;

use App\Models\TestQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestQuestionChoice>
 */
class TestQuestionChoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'test_question_id' => $this->faker->randomDigit(),
            //'test_question_id' => TestQuestion::factory(),
            'choice_title' => $this->faker->word,
            'score' => $this->faker->randomDigit()
        ];
    }
}
