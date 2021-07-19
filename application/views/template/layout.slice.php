<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('page_title')</title>
	@include('template.includes.styles')	
</head>
<body>
	<h1>Hello World</h1>
	@include('template.includes.navbar')

	@include('template.includes.sidebar')

	<div class="content" style="background: green;">
		@yield('page_content')
	</div>
	
	@include('template.includes.scripts')
</body>
</html>