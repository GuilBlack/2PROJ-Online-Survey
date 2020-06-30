<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\User;
use App\Answer;

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
        return view('pages.survey', compact('surveys'));
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
        if ($survey->visible == 0) {
            return redirect('/');
        }elseif ($survey->visible == 2) {
            return redirect('/surveys/'.$survey->id.'/take-private-survey');
        }else{
            return view('survey.takesurvey', compact('survey'));
        }
    }

    public function showConfirmation(Survey $survey) {
        if ($survey->visible == 0) {
            return redirect('/');
        }elseif ($survey->visible == 1) {
            return redirect('/surveys/'.$survey->id.'/take-survey');
        }else {
            return view('survey.confirmation', compact('survey'));
        }
    }

    public function confirmation(Request $request, Survey $survey) {
        $arr = $request->except('_token');
        if ($arr['name'] == $survey->user->name && $arr['title'] == $survey->title) {
            return view('survey.takesurvey', compact('survey'));
        }else {
            return response('Unauthorized.', 403);
        }
    }

    public function showAnalytics(Survey $survey) {
        $this->authorize('view', $survey);
        $questionArr = [];

        //O(n3)
        foreach ($survey->questions as $question) {
            if ($question->type == "checkbox") {
                $newArr = [];
                foreach($question->answers as $answer) {
                    $answerArr = json_decode($answer->answer);
                    foreach($answerArr as $ans) {
                        $tempArr = ["answer" => $ans];
                        array_push($newArr, $tempArr);
                    }
                }
                $questionArr[$question->id] = $newArr;

            }elseif ($question->type == "radio" || $question->type == "number") {
                $newArr = [];
                foreach($question->answers as $answer) {
                    if ($question->type == "radio") {
                        $tempArr = ["answer" => $answer->answer];
                    }else {
                        $tempArr = ["answer" => (int)$answer->answer];
                    }
                    array_push($newArr, $tempArr);
                }
                $questionArr[$question->id] = $newArr;

            }else {
                $newArr = Answer::where('question_id', $question->id)->orderBy('created_at', 'DESC')->get()->pluck('answer')->toArray();
                $questionArr[$question->id] = $newArr;
            }
        }
        return view('survey.show-analytics', compact('survey', 'questionArr'));
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
        if ($survey->visible == 1 || $survey->visible == 2) {
            return redirect('/');
        }
        return view('survey.edit', compact('survey'));
    }

    public function edit(Survey $survey) {
        $this->authorize('view', $survey);
        if ($survey->visible == 1 || $survey->visible == 2) {
            return redirect('/');
        }
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
