<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Answer;

class AnswerController extends Controller
{
    //
    public function store(Request $request, Survey $survey) {
        $request_array = $request->except('_token');
        foreach ($request_array as $key => $value) {
            if (!is_null($value['answer'])) {
                $answer = new Answer();
                if (!is_array($value['answer'])) {
                    $new_answer = $value['answer'];
                }else {
                    $new_answer = json_encode($value['answer']);
                }

                $answer->answer = $new_answer;
                $answer->question_id = $key;
        
                $answer->save();
            }
        };

        return redirect('/');
    }
}
