<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	{{ HTML::style('css/bootstrap-print2.css') }}
	<style>
		.half {
			width: 50%;
		}
		.field-wrap {
			padding: 10px;
		}
		.field-wrap.border {
			border: 1px solid #f3f3f3;
		}
		.field-wrap.label {
			padding: 2px;
		}
		.conditions {
			margin: 5px;
			padding: 0 0 0 10px;
			font-size: 8px;
		}
	</style>
	<title></title> 
</head> 

<body>
	<div class="container-fluid">
		@yield('content')
	</div>
</body>
</html>