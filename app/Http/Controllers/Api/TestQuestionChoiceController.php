<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestQuestionChoicesRequest;
use App\Models\TestQuestionChoice;
use Illuminate\Http\Request;

class TestQuestionChoiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => TestQuestionChoice::all()
        ]);
    }

    public function store(TestQuestionChoicesRequest $request)
    {
        return response()->json([
            'data' => TestQuestionChoice::create($request->all())
        ], 201);
    }

    public function update(TestQuestionChoicesRequest $request, TestQuestionChoice $choice)
    {
        return response()->json([
            'data' => tap($choice)->update($request->all())
        ]);
    }

    public function destroy(TestQuestionChoice $choice)
    {
        $choice->delete();

        return response([], 204);
    }
}
