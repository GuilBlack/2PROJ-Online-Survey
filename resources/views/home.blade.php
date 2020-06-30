@extends('layouts.app')

@section('content')
@guest
     <div class="jumbotron" style="text-align: center">
        <h1 class="display-3">BIG BROTHER</h1>
        <p class="lead">Welcome to <br> Big Brother Survey Editor!</p>
        <hr></hr>
        <p><a class="btn btn-lg btn-success btn-lg" href="{{ route('register') }}" role="button">Sign Up</a></p>
    </div>
@else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Your Unfinished Surveys:</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="/surveys/create" class="btn btn-custom btn-lg btn-block" style="margin-bottom: 15px">Create New Survey</a>
                        @if (count($surveys) > 0)
                            @foreach($surveys as $survey)
                                @if($survey->visible == 0)
                                    <div class="card card-body bg-light" style="margin-bottom: 10px">
                                        <h3>
                                            <a href="/surveys/{{$survey->id}}/questions/create">{{$survey->title}}</a>
                                            <a href="/surveys/{{$survey->id}}/delete"><span class="material-icons" style="font-size: 25px; float: right; color: red;">delete_forever</span></a>
                                            <a href="/surveys/{{$survey->id}}/edit"><span class="material-icons" style="font-size: 25px; float: right;">create</span></a>
                                        </h3>
                                        <h5>Description:</h5>
                                        <p>{{ $survey->description }}</p>
                                        <small>Written on {{$survey->created_at}}</small>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>No Survey Found</p>
                        @endif
                    </div>
                </div>
                </br>
                
                <div class="card">
                    <div class="card-header">
                        <h3>Your Private Surveys:</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @forelse($surveys as $survey)
                            @if($survey->visible == 2)
                                <div class="card card-body bg-light" style="margin-bottom: 10px">
                                    <h3>
                                        <a href="/surveys/{{$survey->id}}/questions/create">{{$survey->title}}</a>
                                        <a href="/surveys/{{$survey->id}}/delete"><span class="material-icons" style="font-size: 25px; float: right; color: red;">delete_forever</span></a>
                                    </h3>
                                    <h5>Description:</h5>
                                    <p>{{ $survey->description }}</p>
                                    <small>Written on {{$survey->created_at}}</small>
                                </div>
                            @endif
                        @empty
                            <p>No Survey Found</p>
                        @endforelse
                    </div>
                </div>
                </br>
                <div class="card">
                    <div class="card-header">
                        <h3>Your Public Surveys:</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @forelse($surveys as $survey)
                            @if($survey->visible == 1)
                                <div class="card card-body bg-light" style="margin-bottom: 10px">
                                    <h3>
                                        <a href="/surveys/{{$survey->id}}/questions/create">{{$survey->title}}</a>
                                        <a href="/surveys/{{$survey->id}}/delete"><span class="material-icons" style="font-size: 25px; float: right; color: red;">delete_forever</span></a>
                                    </h3>
                                    <h5>Description:</h5>
                                    <p>{{ $survey->description }}</p>
                                    <small>Written on {{$survey->created_at}}</small>
                                </div>
                            @endif
                        @empty
                            <p>No Survey Found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest
@endsection
