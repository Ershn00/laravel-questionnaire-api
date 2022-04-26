<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestionChoice extends Model
{
    use HasFactory;

    protected $fillable = ['test_question_id', 'choice_title', 'score'];

    public function questions()
    {
        return $this->belongsTo(TestQuestion::class);
    }
}
