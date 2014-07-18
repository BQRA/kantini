<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kantini Beta</title>
	{{ HTML::script("js/jquery-2.1.1.min.js") }}
	{{ HTML::script("js/bootstrap.js") }}

	{{ HTML::style("css/bootstrap-theme.css") }}
	{{ HTML::style("css/bootstrap.css") }}
	{{ HTML::style("css/style.css") }}

</head>
<body>

<header>
	<nav class="navbar navbar-default" role="navigation">
	    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	    	</button>
	    	<a class="navbar-brand" href="{{ URL::route('home') }}">Kantini Beta</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    	<ul class="nav navbar-nav navbar-right">
	    		<li><a href="{{ URL::route('home') }}">Anasayfa</a></li>
				<li><a href="{{ URL::route('about-us') }}">Hakkımızda</a></li>
				<li><a href="{{ URL::route('kantini') }}">Kantini</a></li>
				<li><a href="{{ URL::route('agreement') }}">Kullanıcı sözleşmesi</a></li>
				<li><a href="{{ URL::route('contact-us') }}">Kontak</a></li>
				<li><a href="{{ URL::route('organization') }}">Etkinlikler</a></li>
				@if(! Sentry::check())
				<li><a href="{{ URL::route('user-register') }}">Kayıt Ol</a></li>
				<li><a href="{{ URL::route('user-login') }}">Giriş Yap</a></li>
				@else
				<li><a href="{{ URL::to('user/'.Sentry::getUser()->username)}}">Profil</a></li>
				<li><a href="{{ URL::route('user-logout') }}">Çıkış</a></li>
				@endif
	    </div><!-- /.navbar-collapse -->
	</nav>
</header>

	<div class="container">
		@yield('content')
	</div>
</body>
</html>