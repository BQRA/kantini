<div class="right-panel">	
	@if(Sentry::check())
	<?php 
		$username 		= Sentry::getUser()->username;
		$user_posts 	= Post::where('username', '=', $username)->where('type', '=', '0');
		$user_likes 	= Like::where('liker', '=', $username);
		$user_comments 	= Comment::where('commenter', '=', $username);
		$user 			= User::with('profile')->whereUsername($username)->firstOrFail();
	?>

	<div class="user-box {{ Sentry::getUser()->gender }}">
		<div class="avatar">
			@if($user->profile->avatar == 'guest')
				{{ HTML::image('/Avatars/guest-avatar.png') }}
			@else
				{{ HTML::image('/Avatars/'.Sentry::getUser()->username.'.jpg') }}
			@endif
		</div>
		<div class="username">
			<span>{{ Sentry::getUser()->username }}</span> 
			<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username).'/edit' }}">(Düzenle)</a>
		</div>
		<div class="custom-line"></div>
		<div class="row numbers">
			<div class="col-sm-4">
				<a href="#">
					{{ $user_posts->count() }} <small>Gönderi</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#">
					{{ $user_likes->count() }} <small>Beğeni</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#">
					{{ $user_comments->count() }} <small>Yorum</small>
				</a>
			</div>
		</div>
	</div>
	@else
	<div class="user-box guest">
		<div class="avatar">
			{{HTML::image('Assets/images/users/guest-avatar.png', 'Avatar')}}
		</div>
		<div class="username">
			<span>{{ $guest_username }}</span>
		</div>
		<div class="custom-line"></div>
		<div class="membership">
			
			<a href="{{ URL::route('register') }}" class="button green w100">KAYIT OL</a>
			<div class="or-line"></div>

			{{ Form::open(array('route' => 'login')) }}
			
			{{ Form::Input('text', 'username', null, array('placeholder' => 'Kullanıcı Adı')) }}
			{{ Form::Input('password', 'password', null, array('placeholder' => 'Şifre')) }}

			{{ Form::submit(' ', ['class' => 'button blue w100']) }}

			{{ Form::close() }}
		</div>
	</div>
	@endif

	<div class="clear mt30"></div>

	<div class="menu-box">
		<!-- <div class="search">
			<input type="text" />
		</div> -->

		<ul class="menu">
			<li><a href="{{ URL::route('home') }}">Anasayfa</a></li>
			<li><a href="{{ URL::route('kantini') }}">Kantini</a></li>
			<li><a href="{{ URL::route('contact.us') }}">Kontak</a></li>
			<li><a href="{{ URL::route('ad') }}">Reklam</a></li>
			<li><a href="{{ URL::route('about.us') }}">Hakkımızda</a></li>
			<li><a href="{{ URL::route('u.dont.know') }}">Bilmedikleriniz</a></li>
			@if(Sentry::check())
			<li><a href="{{ URL::route('logout') }}">Çıkış</a></li>
			@endif
		</ul>
	</div>

</div>