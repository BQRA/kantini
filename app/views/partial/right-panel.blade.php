<div class="right-panel">	
	@if(Sentry::check())
	<div class="user-box {{ Sentry::getUser()->gender }}">
		@if(Sentry::check())
		<div class="logout-button"><a href="{{ URL::route('logout') }}"></a></div>
		@endif
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
				<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username).'/all-posts' }}">
					{{ session_user_posts()->count() }} <small>Gönderi</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username).'/all-comments' }}">
					{{ session_user_comments()->count() }} <small>Yorum</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username).'/all-likes' }}">
					{{ session_user_likes()->count() }} <small>Beğeni</small>
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
			<span>{{ guest_username() }}</span>
		</div>
		<div class="custom-line"></div>
		<div class="membership">
			
			<a href="{{ URL::route('register') }}" class="button green w100">KAYIT OL</a>
			<div class="or-line"></div>

			{{ Form::open(['route' => 'post.login']) }}
			
			{{ Form::Input('text', 'username', null, ['placeholder' => 'Kullanıcı Adı']) }}
			{{ Form::Input('password', 'password', null, ['placeholder' => 'Şifre']) }}

			{{ Form::button(' ', ['class' => 'button blue w100', 'type' => 'submit']) }}

			{{ Form::close() }}
		</div>
	</div>
	@endif

	<div class="clear mt30"></div>

	<div class="menu-box">
		<div class="search">
			{{ Form::open(['method' => 'GET', 'route' => 'search']) }}
			{{ Form::Input('text', 'q', null, ['placeholder' => 'Ara']) }}
			{{ Form::close() }}
		</div>

		<ul class="menu">			
			<li><a href="{{ URL::route('home') }}">Anasayfa</a></li>
			<li><a href="{{ URL::route('contact.us') }}">Kontak</a></li>
			<li><a href="{{ URL::to('beykent') }}">Beykent</a></li>
			<li><a href="{{ URL::to('bahcesehir') }}">Bahçeşehir</a></li>
		</ul>
	</div>

</div>