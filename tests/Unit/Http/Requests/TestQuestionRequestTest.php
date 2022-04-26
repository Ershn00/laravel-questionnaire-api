<?php

namespace Tests\Unit\Http\Requests;

use App\Models\TestQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TestQuestionRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.test_questions.';

    public function test_question_field_is_required()
    {
        $validatedField = 'question';

        // Create assertion
        $question = TestQuestion::factory()->make([
            //$validatedField => Str::random(25)
            $validatedField => null
        ]);

        $this->postJson(route($this->routePrefix . 'store'), $question->toArray())
            ->assertJsonValidationErrors($validatedField);

        // Update assertion
        $updateQuestion = TestQuestion::factory()->create();
        $newQuestion = TestQuestion::factory()->make([
            $validatedField => null
        ]);

        $this->putJson(route($this->routePrefix . 'update', $updateQuestion), $newQuestion->toArray())
            ->assertJsonValidationErrors($validatedField);
    }
}
