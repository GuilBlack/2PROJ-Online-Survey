@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ $survey->title }} Preview: </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Add New question</div>

                <div class="card-body">
                
                    <form action="" method="POST" id="bool">
                        @csrf
                        <div class="row">
                            <select class="form-control form-control-lg" name="type" id="type">
                                <option value="" disabled selected>Choose an option</option>
                                <option value="radio">Radio Buttons</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="text">Text</option>
                                <option value="textarea">Text Area</option>
                            </select>
                        </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection