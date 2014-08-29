<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kantini @yield('title') </title>

	{{HTML::style('Assets/css/bootstrap.min.css')}}
	{{HTML::style('Assets/css/font-awesome.min.css')}}
	{{HTML::style('Assets/css/style.css')}}

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

	<!-- Plugins -->
	{{HTML::script('Assets/plugins/jquery-mask-plugin/js/jquery.mask.min.js')}}	
	<!-- Plugins #end -->

	{{HTML::script('Assets/js/custom-jquery.js')}}
</head>
<body>

@include('partial.header')

@if(Session::has('message'))
	<div class="session-message">
		{{ Session::get('message') }}
	</div>
@endif

@if($errors->has())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<div class="container">
	<div class="left-container">
		@yield('content')
	</div>
	@include('partial.right-panel')
</div>

@include('partial.footer')

</body>
</html>