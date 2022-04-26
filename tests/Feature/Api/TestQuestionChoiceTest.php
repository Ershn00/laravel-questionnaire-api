<?php

namespace Tests\Feature\Api;

use App\Models\TestQuestion;
use App\Models\TestQuestionChoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestQuestionChoiceTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.test_question_choices.';

    public function test_can_create_and_get_question_choices()
    {
        // Create Choice for response
        $entry = TestQuestionChoice::factory()->create();

        $response = $this->getJson(route('api.test_question_choices.index'));

        // Choice created
        $response->assertOk();

        // Assert entry
        $response->assertJson([
            'data' => [[
                'id' => $entry->id,
                'test_question_id' => $entry->test_question_id,
                'choice_title' => $entry->choice_title,
                'score' => $entry->score
            ]]
        ]);
    }

    public function test_can_store_question_choices()
    {
        // Build a TestQuestionChoice factory model.
        $newChoice = TestQuestionChoice::factory()->make();

        $response = $this->postJson(
            route('api.test_question_choices.store'),
            $newChoice->toArray()
        );

        // Assert 201
        $response->assertCreated();

        // Assert choice_title row returned
        $response->assertJson([
            'data' => ['choice_title' => $newChoice->choice_title]
        ]);

        // Assert test_question_choices table
        $this->assertDatabaseHas('test_question_choices', $newChoice->toArray());
    }

    public function test_can_update_question_choices()
    {
        $choice = TestQuestionChoice::factory()->create();
        $newChoice = TestQuestionChoice::factory()->make();

        $response = $this->putJson(
            route($this->routePrefix . 'update', $choice),
            $newChoice->toArray()
        );
        $response->assertJson([
            'data' => [
                'id' => $choice->id,
                'test_question_id' => $newChoice->test_question_id,
                'choice_title' => $newChoice->choice_title,
                'score' => $newChoice->score
            ]
        ]);

        $this->assertDatabaseHas('test_question_choices', $newChoice->toArray());
    }

    public function test_can_delete_question_choices()
    {
        $choice = TestQuestionChoice::factory()->create();

        $this->deleteJson(route($this->routePrefix . 'destroy', $choice))
            ->assertNoContent();

        // Assert the test_question_choices table does not contain the record that is just deleted.
        $this->assertDatabaseMissing('test_question_choices', $choice->toArray());
    }
}
