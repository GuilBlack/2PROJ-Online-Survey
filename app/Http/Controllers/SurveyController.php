<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\User;

class SurveyController extends Controller
{
    //
    public function create() {
        return view('survey.create');
    }

    public function store() {
        $data = request()->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
        ]);

        // $data['user_id'] = auth()->user()->id;

        // $survey = \App\Survey::create($data);

        //can use this form because we established a relationship between User and Surver class
        //else we can use what's up
        $data['visible'] = 0;
        $survey = auth()->user()->surveys()->create($data);

        return redirect('/surveys/'.$survey->id.'/questions/create');
    }

    public function show() {
        $surveys = Survey::where('visible', 1)->orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.survey', compact('surveys', 'users'));
    }

    public function makeVisible(Survey $survey) {
        $this->authorize('view', $survey);
        $survey->visible = 1;
        $survey->save();
        return redirect('/');
    }

    public function makeVisiblePrivately(Survey $survey) {
        $this->authorize('view', $survey);
        $survey->visible = 2;
        $survey->save();
        return redirect('/');
    }

    public function takeSurvey(Survey $survey) {
        return view('survey.takesurvey', compact('survey'));
    }

    public function showAnalytics(Survey $survey) {
        $this->authorize('view', $survey);
        return view('survey.show-analytics', compact('survey'));
    }

    public function delete(Survey $survey) {
        $this->authorize('view', $survey);
        foreach ($survey->questions as $question) {
            foreach($question->answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $survey->delete();
        return redirect('/');
    }

    public function editShow(Survey $survey) {
        $this->authorize('view', $survey);
        return view('survey.edit', compact('survey'));
    }

    public function edit(Survey $survey) {
        $this->authorize('view', $survey);
        $data = request()->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
        ]);
        $survey->title = $data['title'];
        $survey->description = $data['description'];
        $survey->save();

        return redirect('/');
    }

}
