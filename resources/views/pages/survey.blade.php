@extends('layouts.app')

@section('content')
    @include('include.messages')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Surveys<h1></div>

                    <div class="card-body">
                        <form action="/general-survey" method="POST" class="form-inline d-flex justify-content-center md-form form active-cyan-2 mt-2">
                            @csrf
                            <input class="form-control form-control mr-3 w-75" name="search" type="text" placeholder="Search for Survey"
                              aria-label="Search">
                            <button class="btn btn-elegant btn-rounded" type="submit"><span class="material-icons">search</span></button>
                        </form>
                        </br>
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
                            <p>No Surveys Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection