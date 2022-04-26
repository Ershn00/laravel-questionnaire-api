<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['question'];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($test_question) {
            $test_question->choices->each->delete();
        });
    }

    public function choices()
    {
        return $this->hasMany(TestQuestionChoice::class);
    }
}
