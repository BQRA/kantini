<div class="right-panel">	
	@if(Auth::check())
	<div class="user-box {{Auth::user()->profile->gender}}">
		<div class="logout-button"><a href="{{ URL::route('user.logout') }}"></a></div>
		<div class="avatar">
			@if(Auth::user()->profile->avatar == 'guest')
				{{ HTML::image('/Avatars/guest-avatar.png') }}
			@else
				{{ HTML::image('/Avatars/'.Auth::user()->username.'.jpg') }}
			@endif
		</div>
		<div class="username">
			<span>{{Auth::user()->username}}</span> 
			<a href="{{ URL::to('user/profile/'.Auth::user()->username).'/edit' }}">(Düzenle)</a>
		</div>
		<div class="custom-line"></div>
		<div class="row numbers">
			<div class="col-sm-4">
				<a href="{{ URL::to('user/profile/'.Auth::user()->username).'/all-posts' }}">
					{{session_user_posts()->count()}}<small>Gönderi</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="{{ URL::to('user/profile/'.Auth::user()->username).'/all-comments' }}">
					{{session_user_comments()->count()}}<small>Yorum</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#">
					{{session_user_rates()}}<small>Oy</small>
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
			<span>{{guest_username()}}</span>
		</div>
		<div class="custom-line"></div>
		<div class="membership">
			
			<a href="{{ URL::route('user.register') }}" class="button green w100">KAYIT OL</a>
			<div class="or-line"></div>

			{{ Form::open(['action' => 'SessionsController@login']) }}
			
			{{ Form::Input('text', 'username', null, ['placeholder' => 'Kullanıcı Adı']) }}
			@if($errors->has('username'))
				<span class="error">{{ $errors->first('username') }}</span>
			@endif
			
			{{ Form::Input('password', 'password', null, ['placeholder' => 'Şifre']) }}
			@if($errors->has('password'))
				<span class="error">{{ $errors->first('password') }}</span>
			@endif

			{{ Form::button(' ', ['class' => 'button blue w100', 'type' => 'submit']) }}

			{{ Form::close() }}

			@if($errors->has('login'))
			    {{ $errors->first('login') }}
			@endif
			<br>

			<a href="{{ URL::to('password/remind') }}">Şifremi unuttum</a>
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
			<li><a href="#">Kontak</a></li>
			<li><a href="{{ URL::to('uni/beykent') }}">Beykent</a></li>
			<li><a href="{{ URL::to('uni/bahcesehir') }}">Bahçeşehir</a></li>
		</ul>
	</div>

</div>