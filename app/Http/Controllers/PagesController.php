<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    public function index() {
        $title = 'Welcome to Online Survey!';
        if (Auth::check()) {
            $this->middleware('auth'); //preventing not logged in people to have access to this
            $surveys = Survey::where('user_id', auth()->user()->id)->paginate(10);
            $data = array(
                'title' => $title,
                'surveys' => $surveys
            );
        }else {
            $data = array(
                'title' => $title
            );
        }
        return view('home')->with($data);
    }

    public function about() {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function survey() {
        $data = array(
            'title' => 'Surveys',
        );
        return view('pages.survey')->with($data);
    }
}
