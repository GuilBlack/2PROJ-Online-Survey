@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>{{$survey->title}}</h3></div>

                    <div class="card-body">
                        <form action="/surveys/{{$survey->id}}/answers" method="POST">
                            @csrf
                            @forelse ($survey->questions as $key=>$question)
                                <h4>Question {{$key+1}}</h4>
                                <div class="card">
                                    <div class="card-header" id="{{$question->id}}-heading">
                                        <h5 class="mb-0">
                                                {{$question->question}}
                                        </h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="container">
                                                @if($question->type === 'text')
                                                <input type="text" class="form-control" placeholder="Write your answer here!" name="{{ $question->id }}[answer]" autocomplete="off"/>
                                                @elseif($question->type === 'textarea')
                                                    <textarea type="text" class="form-control" placeholder="Write your answer here!" rows="5" data-form-field="Message" id="{{$question->id}}-input" name="{{ $question->id }}[answer]"></textarea>
                                                @elseif($question->type === 'radio')
                                                    @foreach ($question->option as $key=>$value)
                                                        <input class="form-check-input" type="radio" id="{{$question->id}}-{{ $key }}" name="{{ $question->id }}[answer]" value="{{$value}}"
                                                        @if ($key == 0)
                                                            checked
                                                        @endif />
                                                        <label class="form-check-label" for="{{$question->id}}-{{ $key }}" style="margin-bottom: 0.5em">{{ $value }}</label></br>
                                                    @endforeach
                                                @elseif($question->type === 'checkbox')
                                                    @foreach ($question->option as $key=>$value)
                                                        <input class="form-check-input" type="checkbox" id="{{$question->id}}-{{ $key }}" name="{{ $question->id }}[answer][]" value="{{$value}}"/>
                                                        <label class="form-check-label" for="{{$question->id}}-{{ $key }}" style="margin-bottom: 0.5em">{{ $value }}</label></br>
                                                    @endforeach
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                </br>
                            @empty
                                <p class="text-lg-left">No Questions Added Yet</p>
                            @endforelse
                            <span class="input-group-btn"><button type="submit" class="btn btn-lg btn-form btn-info display-4">Submit</button></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection