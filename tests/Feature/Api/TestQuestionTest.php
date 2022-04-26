<?php

namespace Tests\Feature\Api;

use App\Models\TestQuestionChoice;
use App\Models\TestQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestQuestionTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.test_questions.';

    public function test_can_create_and_fetch_questions()
    {
        // Create Question for response
        $entry = TestQuestion::factory()->create();

        $response = $this->getJson(route('api.test_questions.index'));

        // Question created
        $response->assertOk();

        // Assert entry
        $response->assertJson([
            'data' => [[
                'id' => $entry->id,
                'question' => $entry->question
            ]]
        ]);
    }

    public function test_can_store_question()
    {
        // Build a TestQuestion factory model.
        $newQuestion = TestQuestion::factory()->make();

        $response = $this->postJson(
            route('api.test_questions.store'),
            $newQuestion->toArray()
        );

        // Assert 201
        $response->assertCreated();

        // Assert question row returned
        $response->assertJson([
            'data' => ['question' => $newQuestion->question]
        ]);

        // Assert test_questions table
        $this->assertDatabaseHas('test_questions', $newQuestion->toArray());
    }

    public function test_can_update_question()
    {
        $question = TestQuestion::factory()->create();
        $newQuestion = TestQuestion::factory()->make();

        $response = $this->putJson(
            route($this->routePrefix . 'update', $question),
            $newQuestion->toArray()
        );
        $response->assertJson([
            'data' => [
                'question' => $newQuestion->question
            ]
        ]);

        $this->assertDatabaseHas('test_questions', $newQuestion->toArray());
    }

    public function test_can_delete_question()
    {
        $question = TestQuestion::factory()->create();

        $this->deleteJson(route($this->routePrefix . 'destroy', $question))
            ->assertNoContent();

        // Assert the test_questions table does not contain the record that is just deleted.
        $this->assertDatabaseMissing('test_questions', $question->toArray());
    }
}
