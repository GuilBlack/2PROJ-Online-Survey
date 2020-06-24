<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;

class QuestionsController extends Controller
{
    //
    public function create(Survey $survey) {

        $this->authorize('view', $survey);
        return view('question.create', compact('survey'));
    }

    public function store(Request $request, Survey $survey) {

        $this->authorize('view', $survey);
        $data = $request->validate([
            'type' => 'required|string|min:1|max:255',
            'question' => 'required|string|min:1|max:255',
            'option' => 'array|max:255|nullable',
            'option.*' => 'min:1|max:255|string'
        ]);
        $survey->questions()->create($data);
        
        return back();
    }

    public function show(Question $question) {
        $this->authorize('view', $question->survey);
        if ($question->survey->visible == 1 || $question->survey->visible == 2) {
            return redirect('/');
        }
        
        return view('question.show', compact('question'));
    }

    public function edit(Request $request, Question $question) {

        $this->authorize('view', $question->survey);
        if ($question->survey->visible == 1 || $question->survey->visible == 2) {
            return redirect('/');
        }

        $data = $request->validate([
            'question' => 'required|string|min:1|max:255',
            'option' => 'array|max:255|nullable',
            'option.*' => 'min:1|max:255|string'
        ]);
        $question->question = $data['question'];
        if(isset($data['option'])) {
        $question->option = $data['option'];
        }
        $question->save();

        return redirect('/surveys/'.$question->survey->id.'/questions/create');
    }

    public function delete(Question $question) {

        $this->authorize('view', $question->survey);
        $question->delete();
        return redirect('/surveys/'.$question->survey->id.'/questions/create');
    }
}
