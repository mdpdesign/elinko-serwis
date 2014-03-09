@extends('layouts.admin')

@section('content')
	<h1>Ilośc zleceń z danego dnia <small>Okres od: {{ $dates[0] }} do: {{ $dates[count($dates)-1] }} </small></h1>
	<div class="chartContainer row">
		<div class="col-md-12">
			<canvas id="chart" width="1140" height="400"></canvas>
		</div>
	</div>	
@stop

@section('footer-scripts')
{{ HTML::script('js/vendor/chart.min.js') }}

<script>
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
</script>

@stop