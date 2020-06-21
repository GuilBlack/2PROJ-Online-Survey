<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class SurveyController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

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
        $survey = auth()->user()->surveys()->create($data); 

        return redirect('/surveys/'.$survey->id.'/questions/create');
    }

    public function show() {
        return view('survey.show');
    }

}
