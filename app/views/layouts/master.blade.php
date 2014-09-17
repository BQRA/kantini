<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kantini @yield('title') </title>

	{{HTML::style('Assets/css/bootstrap.min.css')}}
	{{HTML::style('Assets/css/style.css')}}

	{{HTML::script('Assets/js/jquery-1.11.1.min.js')}}	

	<!-- Plugins -->
	{{HTML::script('Assets/plugins/jquery-mask-plugin/js/jquery.mask.min.js')}}	
	<!-- Plugins #end -->

	{{HTML::script('Assets/js/custom-jquery.js')}}

</head>
<body>

@include('partial.header')

@if(Session::has('message'))
	<div class="notification info">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif

@if($errors->has())
	<div class="notification error">
	    @foreach ($errors->all() as $error)
	        <p>{{ $error }}</p>
	    @endforeach
	</div>
@endif

<div class="container">
	<div class="left-container">
		@yield('content')
	</div>
	@include('partial.right-panel')
</div>

@include('partial.footer')

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54929805-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>