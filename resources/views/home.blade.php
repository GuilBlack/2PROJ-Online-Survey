@extends('layouts.app')

@section('content')
@guest
    <div class="jumbotron" style="text-align: center">
        <h1 class="display-3">{{config('app.name', 'Online Survey')}}</h1>
        <p class="lead">Hello there o/ <br> This is the Online Survey!</p>
        <p><a class="btn btn-lg btn-success btn-lg" href="{{ route('register') }}" role="button">Sign Up</a></p>
    </div>
@else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="/surveys/create" class="btn btn-custom btn-lg btn-block">Create New Survey</a>
                        <h1>Your Surveys:</h1>
                        @if (count($surveys) > 0)
                            @foreach($surveys as $survey)
                                <div class="card card-body bg-light" style="margin-bottom: 10px">
                                    <h3>
                                        <a href="/surveys/{{$survey->id}}/questions/create">{{$survey->title}}</a>
                                        <a href="/surveys/{{$survey->id}}/delete"><span class="material-icons" style="font-size: 25px; float: right; color: red;">delete_forever</span></a>
                                    </h3>
                                    <h5>Description:</h5>
                                    <p>{{ $survey->description }}</p>
                                    <small>Written on {{$survey->created_at}}</small>
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
@endguest
@endsection
