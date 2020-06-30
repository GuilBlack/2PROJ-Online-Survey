@extends('layouts.app')

@section('content')
<div class="container" style="width: 100%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Analytics<h1>
                </div>

                <div class="card-body">
                    @foreach ($survey->questions as $question)
                        @if($question->type == "checkbox" || $question->type == "radio" || $question->type == "number")
                            <div class="card">
                                <div class="card-header">
                                    {{$question->question}}
                                </div>
                                <div class="card-body" id="q-{{$question->id}}-container">
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
                                    <div class="my-custom-scrollbar">

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
<script src="{{ asset('js/colorbrewer.js') }}"></script>

@foreach ($survey->questions as $question)
    @if ($question->type == "checkbox" || $question->type == "radio")
        <script defer> 
            var pieChart = dc.pieChart("#q-{{ $question->id }}");

            var answers = @json($questionArr[$question->id], JSON_PRETTY_PRINT);
            
            var cf = crossfilter(answers);
            var answersDim = cf.dimension(function(d){ return d.answer;}, true);
            var answersGroup = answersDim.group();

            pieChart
                .ordinalColors(['#8900ac', '#0f2bba', '#ffa600', '#c20096', '#ff7e24', '#ff125d', '#ff5241', '#e9007a'])
                .width(document.getElementById('q-{{$question->id}}-container').offsetWidth)
                .height(300)
                .slicesCap(7)
                .innerRadius(50)
                .externalLabels(30)
                .externalRadiusPadding(50)
                .drawPaths(true)
                .dimension(answersDim)
                .group(answersGroup)
                .legend(dc.legend().x(0).y(20).itemHeight(13).itemWidth(-20).gap(5))
                .on('pretransition', function(chart) {
                    chart.selectAll('text.pie-slice').text(function(d) {
                        return dc.utils.printSingleValue((d.endAngle - d.startAngle) / (2*Math.PI) * 100) + '%';
                    })
                });;
            

            var rowChart = dc.rowChart("#q-{{$question->id}}-row")
                .ordinalColors(['#8900ac', '#0f2bba', '#ffa600', '#c20096', '#ff7e24', '#ff125d', '#ff5241', '#e9007a'])
                .renderLabel(true)
                .height(250)
                .width(document.getElementById('q-{{$question->id}}-container').offsetWidth)
                .dimension(answersDim)
                .group(answersGroup)
                .cap(7)
                .ordering(function(d){return -d.value;})
                .xAxis().ticks(4);

            dc.renderAll();
        </script>
    @elseif($question->type == "number")
        <script>
            var barChart = dc.barChart("#q-{{ $question->id }}");
            var answers = @json($questionArr[$question->id], JSON_PRETTY_PRINT);
            var min = 100;
            var max = 0;
            
            var cf = crossfilter(answers);
            var answersDim = cf.dimension(function(d){ return d.answer;}, true);
            var answersGroup = answersDim.group().reduceCount();
            dimData = answersGroup.top(Infinity);

            if(Object.keys(dimData).length == 0) {
                min = 0;
                max = 100;
            }

            dimData.forEach(function (x) {
                if (min > Object.values(x)[0]) {
                    min = Object.values(x)[0];
                }
                if (max < Object.values(x)[0]) {
                    max = Object.values(x)[0];
                }
            });

            barChart
                .colorAccessor(d => d.key)
                .colors("#9683EC") //d3.scale.ordinal().domain([min,max]).range(colorbrewer.RdBu[Object.keys(dimData).length])
                .width(document.getElementById('q-{{$question->id}}-container').offsetWidth)
                .height(400)
                .x(d3.scale.linear().domain([min,max+1]))
                .brushOn(false)
                .yAxisLabel("Count")
                .dimension(answersDim)
                .group(answersGroup)
                .elasticY(true)
                .on('renderlet', function(chart) {
                    chart.selectAll('rect').on("click", function(d) {
                        console.log("click!", d);
                    });
                });

            dc.renderAll();


        </script>
        
    @endif
@endforeach

@endsection