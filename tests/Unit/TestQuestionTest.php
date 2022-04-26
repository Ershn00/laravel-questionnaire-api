<?php

namespace Tests\Unit;

use App\Models\TestQuestion;
use App\Models\TestQuestionChoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function createTestQuestion($args = [])
    {
        return TestQuestion::factory()->create($args);
    }

    public function createTestQuestionChoice($args = [])
    {
        return TestQuestionChoice::factory()->create($args);
    }

    public function test_if_question_id_deleted_then_all_its_choices_would_be_deleted()
    {
        $question = $this->createTestQuestion();
        $choice = $this->createTestQuestionChoice(['test_question_id' => $question->id]);
        $choice2 = $this->createTestQuestionChoice();

        // Delete Question
        $question->delete();

        $this->assertDatabaseMissing('test_questions',['id' => $question->id]);
        $this->assertDatabaseMissing('test_question_choices',['id' => $choice->id]);
        $this->assertDatabaseHas('test_question_choices',['id' => $choice2->id]);
    }
}
