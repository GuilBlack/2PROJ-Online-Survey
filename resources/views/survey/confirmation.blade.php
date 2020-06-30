@extends('layouts.app')

@section('content')
@include('include.optional-message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Confirmation Form</div>

                <div class="card-body">
                    <form action="/surveys/{{$survey->id}}/take-private-survey" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Company Name:</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Company Name" id="name" autocomplete="off">
                            <small id="nameHelp" class="form-text text-muted">Please enter your company name EXACTLY as it is supposed to be written for confirmation</small>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Survey Title:</label>
                            <input name="title" type="text" class="form-control" placeholder="Enter Survey Name" id="title" autocomplete="off">
                            <small id="titleHelp" class="form-text text-muted">Please enter the survey's name EXACTLY as it is supposed to be written for confirmation</small>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Confirm</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection