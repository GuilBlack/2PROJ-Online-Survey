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
        $optionalMessages = [];
        $count = 1;
        foreach ($survey->questions as $question) {
            $foo = False;
            if($question->optional == 0) {
                //
                foreach($request_array as $key => $value) {
                    if ($question->id == $key) {
                        if (!is_null($value['answer'])) {
                            $foo = True;
                        }
                        break;
                    }
                }
                if ($foo == False) {
                    $optionalMessages[$question->id] = 'The Question '.$count.' Isn\'t Optional!';
                }
            }
            ++$count;
        }
        if (sizeof($optionalMessages) > 0) {
            return back()->with('optionalMessages', $optionalMessages);
        }
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
