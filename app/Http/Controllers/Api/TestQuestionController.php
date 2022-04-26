<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestQuestionRequest;
use App\Models\TestQuestion;
use Illuminate\Http\Request;

class TestQuestionController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => TestQuestion::all()
        ]);
    }

    public function store(TestQuestionRequest $request)
    {
        return response()->json([
            'data' => TestQuestion::create($request->all())
        ], 201);
    }

    public function edit($id)
    {
        $question = TestQuestion::find($id);
        return response()->json($question);
    }

    public function update(TestQuestionRequest $request, TestQuestion $question)
    {
        return response()->json([
            'data' => tap($question)->update($request->all())
        ]);
    }

    public function destroy(TestQuestion $question)
    {
        $question->delete();

        return response([], 204);
    }
}
