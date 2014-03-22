@extends('layouts.admin')

@section('styles')
{{ HTML::style('css/nv.d3.css') }}
@stop

@section('content')
	<div class="chartContainer row">
		<div class="col-md-12">
			<h1 class="text-center">Ilośc zleceń z danego dnia <small>Okres od: {{ $dates[0] }} do: {{ $dates[count($dates)-1] }} </small></h1>
			<div id="main-chart">
				<svg style="height:400px;"></svg>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center">Zlecenia wg. statusów</h3>
			<div id="status-chart">
				<svg style="height:400px;"></svg>
			</div>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">Zlecenia wg. oddziałów</h3>
			<div id="branch-chart">
				<svg style="height:400px;"></svg>
			</div>
		</div>
	</div>
@stop

@section('footer-scripts')
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
	.margin({top: 30, right: 35, bottom: 30, left: 35})
	.showControls(false)
	.clipEdge(false)
	.useInteractiveGuideline(true);

	chart.xAxis.showMaxMin(true).tickFormat(function(d) { return d3.time.format('%Y-%m-%d')(new Date(d)) });
	chart.yAxis.tickFormat(d3.format('d'));

	d3.select('#main-chart svg')
	.datum(data)
	.transition().duration(500).call(chart);

	nv.utils.windowResize(chart.update);

	return chart;
});

//Regular pie chart example
nv.addGraph(function() {

	var data = {{ $status_data }}

	var chart = nv.models.pieChart()
	.x(function(d) { return d.status })
	.y(function(d) { return parseInt(d.count) })
	.labelType("percent")
	.showLabels(true);

	d3.select("#status-chart svg")
	.datum(data)
	.transition().duration(750)
	.call(chart);

	nv.utils.windowResize(chart.update);

	return chart;
});

//Regular pie chart example
nv.addGraph(function() {

	var data = {{ $branch_data }}

	var chart = nv.models.pieChart()
	.x(function(d) { return d.branch })
	.y(function(d) { return parseInt(d.count) })
	.labelType("percent")
	.showLabels(true);

	d3.select("#branch-chart svg")
	.datum(data)
	.transition().duration(1000)
	.call(chart);

	nv.utils.windowResize(chart.update);

	return chart;
});
</script>
@stop