@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Analytics<h1>
                </div>

                <div class="card-body">
                    @foreach ($survey->questions as $question)
                        @if($question->type == "checkbox" || $question->type == "radio")
                            <div class="card">
                                <div class="card-header">
                                    {{$question->question}}
                                </div>
                                <div class="card-body">
                                    <div id="q-{{$question->id}}-row"></div>
                                    <div id="q-{{$question->id}}"></div>
                                </div>
                            </div></br>
                        @else
                            <div class="card">
                                <div class="card-header">
                                    {{$question->question}}
                                </div>
                                <div class="card-body">
                                    <div style="height:300px;overflow:auto;">

                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                                <th scope="col">#</th>
                                                <th scope="col">Message</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($questionArr[$question->id] as $key=>$message)
                                                    <tr>
                                                        <th scope="row">{{$key+1}}</th>
                                                        <td>{{$message}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div></br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/d3.js') }}"></script>
<script src="{{ asset('js/crossfilter.js') }}"></script>
<script src="{{ asset('js/dc.js') }}"></script>

@foreach ($survey->questions as $question)
    @if ($question->type == "checkbox" || $question->type == "radio")
        <script defer>
            var id{{$question->id}} = "#q-{{ $question->id }}";
            console.log(id{{$question->id}});   
            var pieChart = dc.pieChart("#q-{{ $question->id }}");

            var answers = @json($questionArr[$question->id], JSON_PRETTY_PRINT);
            
            var cf = crossfilter(answers);
            var answersDim = cf.dimension(function(d){ return d.answer;}, true);
            console.log(answersDim.top(Infinity));
            var answersGroup = answersDim.group();
            console.log(answersGroup.top(Infinity));

            pieChart
                .width(250)
                .height(250)
                .dimension(answersDim)
                .group(answersGroup);
            

            var rowChart = dc.rowChart("#q-{{$question->id}}-row")
                .renderLabel(true)
                .height(250)
                .width(350)
                .dimension(answersDim)
                .group(answersGroup)
                .cap(4)
                .ordering(function(d){return -d.value;})
                .xAxis().ticks(4);

            dc.renderAll();
        </script>
    @endif
@endforeach

@endsection