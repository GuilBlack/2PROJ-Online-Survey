@extends('layouts.app')

@section('content')
    @include('include.messages')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Surveys<h1></div>

                    <div class="card-body">
                        @auth
                        <a href="/surveys/create" class="btn btn-custom btn-lg btn-block" style="margin-bottom: 15px">Create New Survey</a>
                        @endauth
                        @if (count($surveys) > 0)
                            @foreach($surveys as $survey)
                                
                                <div class="card card-body bg-light" style="margin-bottom: 10px">
                                    <h3><a href="/surveys/{{$survey->id}}/take-survey">{{$survey->title}}</a></h3>
                                    <h5>Description:</h5>
                                    <p>{{ $survey->description }}</p>
                                    <small>Written by {{$survey->user->name}} on {{$survey->created_at}}</small>
                                </div>
                            @endforeach
                            {{$surveys->links()}}
                        @else
                            <p>No Messages Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection