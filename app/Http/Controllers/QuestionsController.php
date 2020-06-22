<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class QuestionsController extends Controller
{
    //
    public function create(Survey $survey) {
        return view('question.create', compact('survey'));
    }

    public function store(Request $request, Survey $survey) {
        $data = $request->validate([
            'type' => 'required|string|min:1|max:255',
            'question' => 'required|string|min:1|max:255',
            'option' => 'array|max:255|nullable',
            'option.*' => 'min:1|max:255|string'
        ]);
        $survey->questions()->create($data);
        
        return back();
    }
}
