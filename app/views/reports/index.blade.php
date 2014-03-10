@extends('layouts.admin')

@section('styles')
{{ HTML::style('css/nv.d3.css') }}
@stop

@section('content')
	<h1>Ilośc zleceń z danego dnia <small>Okres od: {{ $dates[0] }} do: {{ $dates[count($dates)-1] }} </small></h1>
	<div class="chartContainer row">
		<div class="col-md-12">
			<div id="chart" width="1140" height="400">
				<svg style="height:400px;"></svg>
			</div>
		</div>
	</div>	
@stop

@section('footer-scripts')
{{-- HTML::script('js/vendor/chart.min.js') --}}
{{ HTML::script('js/vendor/d3.min.js') }}
{{ HTML::script('js/vendor/nv.d3.min.js') }}

<script>
nv.addGraph(function() {

	var data = [{
		'key' : 'Ilość zleceń w dniu',
		'values' : {{ $data }}
	}];

	var chart = nv.models.stackedAreaChart()
	            .x(function(d) {
	            	return new Date(Date.parse(d.date)).getTime();
	            })
	            .y(function(d) { return parseInt(d.count) })
	            .showControls(false)
	            .clipEdge(false)
	            .useInteractiveGuideline(true);

	chart.xAxis.showMaxMin(true).tickFormat(function(d) { return d3.time.format('%Y-%m-%d')(new Date(d)) });
	chart.yAxis.tickFormat(d3.format('d'));

	d3.select('#chart svg')
	.datum(data)
	.transition().duration(500).call(chart);

	nv.utils.windowResize(chart.update);

	return chart;
});
</script>

<!-- <script>
	var steps = 20;
	var max = Math.max.apply(Math, {{ json_encode($values, JSON_NUMERIC_CHECK) }} );
	var options = {
		bezierCurve : false,
		scaleOverride: true,
		scaleSteps: steps,
		scaleStepWidth: Math.ceil(max / steps),
		scaleStartValue: 0,
	};
	var data = {
		labels : {{ json_encode($dates) }},
		datasets : [
		{
			fillColor : "rgba(151,187,205,0.5)",
			strokeColor : "rgba(151,187,205,1)",
			pointColor : "rgba(151,187,205,1)",
			pointStrokeColor : "#fff",
			data : {{ json_encode($values, JSON_NUMERIC_CHECK) }}
		}
		]
	}

	//Get the context of the canvas element we want to select
	var ctx = document.getElementById("chart").getContext("2d");
	var myNewChart = new Chart(ctx).Line(data, options);
</script> -->

@stop