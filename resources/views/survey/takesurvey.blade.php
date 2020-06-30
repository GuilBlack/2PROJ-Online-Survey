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
                                                @if ($question->optional == 0)
                                                    <span style="color: red">*</span>
                                                @endif
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
                                                        <div class="custom-control custom-radio">
                                                            <input class="form-check-input" type="radio" id="{{$question->id}}-{{ $key }}" name="{{ $question->id }}[answer]" value="{{$value}}"/>
                                                            <label class="form-check-label" for="{{$question->id}}-{{ $key }}" style="margin-bottom: 0.5em">{{ $value }}</label>
                                                        </div>
                                                    @endforeach
                                                @elseif($question->type === 'checkbox')
                                                    @foreach ($question->option as $key=>$value)
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="{{$question->id}}-{{ $key }}" name="{{ $question->id }}[answer][]" value="{{$value}}"/>
                                                            <label class="custom-control-label" for="{{$question->id}}-{{ $key }}" style="margin-bottom: 0.5em">{{ $value }}</label>
                                                        </div>
                                                    @endforeach
                                                @elseif($question->type === 'number')
                                                    <div class="form-group option-group">
                                                        <input placeholder="Enter Value Here" name="{{ $question->id }}[answer]" type="number" class="form-control"
                                                        @foreach ($question->option as $key=>$minMax)
                                                            @if ($key == 0)
                                                                min="{{$minMax}}"
                                                            @else
                                                                max="{{$minMax}}"
                                                            @endif
                                                        @endforeach />
                                                    </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                @if (session('optionalMessages'))
                                    @foreach (session('optionalMessages') as $messageKey=>$message)
                                        @if ($messageKey == $question->id)
                                            <small class="text-danger">{{ $message }}</small>
                                        @endif
                                    @endforeach
                                @endif
                                </br>
                            @empty
                                <p class="text-lg-left">No Questions Added Yet</p>
                            @endforelse
                            <span class="input-group-btn"><button type="submit" class="btn btn-lg btn-form btn-primary display-4">Submit</button></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection