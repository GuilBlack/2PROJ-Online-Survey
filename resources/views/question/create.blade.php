@extends('layouts.app')
@section('content')
@include('include.messages')

@if ($survey->visible != 1 && $survey->visible != 2)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><h3>Add New Question</h3></div>

                <div class="card-body">
                <p class="alert-warning" role="alert">&nbsp; &nbsp;<span style="font-weight: bold;">!</span> Once you click on publish, you will not be able to add new questions or edit/delete existing ones.</p>
                <form action="/surveys/{{ $survey->id }}/questions" method="POST">
                        @csrf
                        <div class="row">
                            <select class="form-control form-control-lg" name="type" id="type">
                                <option value="" disabled selected>Choose an option</option>
                                <option value="text">Text</option>
                                <option value="radio">Radio Buttons</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="textarea">Text Area</option>
                            </select>
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="question"><h5>Question:</h5></label>
                            <input name="question" type="text" class="form-control" placeholder="Enter Your Question Here" id="question" autocomplete="off">
                            <small id="titleHelp" class="form-text text-muted">Please write your question here.</small>
                        </div>

                        <div id="option-place"></div>
                        </br>
                        <button type="submit" class="btn btn-primary">Add Question</button>
                </div>

            </div>
        </div>
    </div>
</div>
</br>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $survey->title }} Preview for Each Questions:</h3>
                </div>

                <div class="card-body">
                    @if ($survey->visible == 1 || $survey->visible == 2)
                        <a class="btn btn-primary btn-lg" href="/analytics/{{$survey->id}}" style="float: right">
                            <span class="material-icons" style="font-size: 25px; float: left;">insert_chart</span>&nbsp;
                            Show Analytics
                        </a>
                        <p>Take Survey on this link:</p>
                        @if ($survey->visible == 2)
                            <a href="/surveys/{{$survey->id}}/take-private-survey" style="font-size: 20px;">http://online-survey.test/surveys/{{$survey->id}}/take-private-survey</a></br></br>
                        @else
                            <a href="/surveys/{{$survey->id}}/take-survey" style="font-size: 20px;">http://online-survey.test/surveys/{{$survey->id}}/take-survey</a></br></br>
                        @endif
                    @endif
                    <div class="accordion" id="accordionExample">
                            @forelse ($survey->questions as $question)
                                <div class="card">
                                    <div class="card-header" id="{{$question->id}}-heading">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-link text-left" data-toggle="collapse" data-target="#{{$question->id}}-collapse" aria-expanded="false" aria-controls="{{$question->id}}-collapse">
                                                {{$question->question}}
                                            </button>
                                            @if ($survey->visible != 1 && $survey->visible != 2)
                                            <a href="/questions/{{$question->id}}/delete"><span class="material-icons" style="font-size: 25px; float: right; color: red; margin-left: 5px">delete_forever</span></a>
                                            <a href="/questions/{{$question->id}}/show"><span class="material-icons" style="font-size: 25px; float: right;">create</span></a>
                                            @endif
                                        </h5>
                                    </div>

                                    <div id="{{$question->id}}-collapse" class="collapse" aria-labelledby="{{$question->id}}-heading" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="container">
                                                    @if($question->type === 'text')
                                                    <input type="text" class="form-control" placeholder="Write your answer here!" />
                                                    @elseif($question->type === 'textarea')
                                                        <textarea type="text" class="form-control" placeholder="Write your answer here!" name="message" rows="5" data-form-field="Message" id="{{$question->id}}-input"></textarea>
                                                    @elseif($question->type === 'radio')
                                                        @foreach ($question->option as $key=>$value)
                                                            <input class="form-check-input" type="radio" id="{{$question->id}}-{{ $key }}" value="{{$value}}"
                                                            @if ($key == 0)
                                                                checked
                                                            @endif />
                                                            <label class="form-check-label" for="{{$question->id}}-{{ $key }}">{{ $value }}</label></br></br>
                                                        @endforeach
                                                    @elseif($question->type === 'checkbox')
                                                        @foreach ($question->option as $key=>$value)
                                                            <input class="form-check-input" type="checkbox" id="{{$question->id}}-{{ $key }}" />
                                                            <label class="form-check-label" for="{{$question->id}}-{{ $key }}">{{ $value }}</label></br></br>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-lg-left">No Questions Added Yet</p>
                            @endforelse
                    </div>
                    @if ($survey->visible == 1 || $survey->visible == 2)
                        <a class="btn btn-danger btn-lg" href="/surveys/{{ $survey->id }}/delete" style="margin-top: 10px">Delete</a>
                    @else
                        @if (count($survey->questions) >= 1)
                            <a class="btn btn-primary btn-lg" href="/surveys/{{ $survey->id }}/make-public" style="margin-top: 10px">Publish</a>
                            <a class="btn btn-primary btn-lg" href="/surveys/{{ $survey->id }}/make-private" style="margin-top: 10px; float: right;">Publish Privately</a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/question-type.js') }}" defer></script>
<script src="{{ asset('js/toggle.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous" defer></script>
@endsection