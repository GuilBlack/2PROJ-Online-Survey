@extends('layouts.app')
@section('content')
@include('include.messages')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Edit Question</h3></div>

                <div class="card-body">
                    <form action="/questions/{{$question->id}}/edit" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question"><h5>Question:</h5></label>
                            <input name="question" type="text" class="form-control" placeholder="Enter Your Question Here" id="question" autocomplete="off" value="{{$question->question}}">
                        </div>
                        
                        @if ($question->type == "radio" || $question->type == "checkbox")
                            <div id="option-place">
                                <span class="btn btn-success add-option" style="cursor:pointer; margin-bottom:5px;">Add Option</span>
                                @foreach ($question->option as $key=>$option)
                                    <div class="form-group option-group">
                                        <label for="option">Option {{$key+1}}</label>
                                        <input name="option[]" id="option[]" placeholder="Enter Option Here" type="text" class="form-control" autocomplete="off" value="{{$option}}">
                                        @if ($key > 1)
                                            <span class="btn btn-danger btn-sm delete-option" style="cursor:pointer; float:right; margin-top:5px">Delete</span>
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                        @endif
                        </br>
                        <button type="submit" class="btn btn-primary">Edit Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/question-edit.js') }}" defer></script>
@endsection