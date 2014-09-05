<div class="right-panel">	
	@if(Auth::check())
	<div class="user-box {{Auth::user()->profile->gender}}">
		<div class="logout-button tooltip" data-content="Çıkıs Yap"><a href="{{ URL::route('user.logout') }}"></a></div>
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
				<a href="{{ URL::to('user/profile/'.Auth::user()->username).'/all-votes' }}">
					{{session_user_votes()->count()}}<small>Oy</small>
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
		<div class="membership req">
			
			<a href="{{ URL::route('user.register') }}" class="button green w100">KAYIT OL</a>
			<div class="or-line"></div>

			{{ Form::open(['action' => 'SessionsController@login']) }}
			
			<div class="rel">
				{{ Form::Input('text', 'username', null, ['placeholder' => 'Kullanıcı Adı', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
			</div>
			<div class="rel">
				<a href="{{ URL::to('password/remind') }}" class="forgot-pass"><span class="icon tooltip" data-content="Şifremi Unuttum">&#61780</span></a>
				{{ Form::Input('password', 'password', null, ['placeholder' => 'Şifre', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
			</div>

			{{ Form::button(' ', ['class' => 'button blue w100', 'type' => 'submit', 'data-validator']) }}

			{{ Form::close() }}
		</div>
	</div>
	@endif

	<div class="clear mt30"></div>

	<div class="menu-box">
		<div class="search req">
			{{ Form::open(['method' => 'GET', 'route' => 'search']) }}
			<label>
				{{ Form::Input('text', 'q', null, ['placeholder' => 'Ara', 'data-valid' => 'required', 'data-message' => 'Aramak için bir kelime girin']) }}
			</label>
			{{ Form::button(' ', ['class' => 'd-none', 'type' => 'submit', 'data-validator']) }}
			{{ Form::close() }}
		</div>

		<ul class="menu">		
			<li><a href="{{ URL::route('home') }}">Anasayfa</a></li>
			<li><a href="#">Kontak</a></li>
		</ul>
	</div>

</div>