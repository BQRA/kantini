<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kantini @yield('title') </title>

	{{HTML::style('Assets/css/bootstrap.min.css')}}
	{{HTML::style('Assets/css/style.css')}}

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	{{HTML::script('Assets/js/custom-jquery.js')}}
</head>
<body>

<?php 
	if(Sentry::check()) {
		$user = User::with('profile')->whereUsername(Sentry::getUser()->username)->firstOrFail(); 
	}
?>
@include('partial.header')

<div class="container">
	<div class="left-container">
	
		@if(Session::has('message'))
		<div class="session-message">
			{{ Session::get('message') }}
		</div>
		@endif

		@yield('content')
	</div>
	@include('partial.right-panel')
</div>

@include('partial.footer')

</body>
</html>