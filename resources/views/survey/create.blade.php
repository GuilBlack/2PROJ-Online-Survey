@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Survey</div>

                <div class="card-body">
                    <form action="/surveys" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input name="title" type="text" class="form-control" placeholder="Enter Title Here" id="title">
                            <small id="emailHelp" class="form-text text-muted">Please give your survey a title that makes sens.</small>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input name="description" type="text" class="form-control" placeholder="Enter Description Here" id="description">
                            <small id="descriptionHelp" class="form-text text-muted">Write a little description about your survey.</small>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Survey</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection