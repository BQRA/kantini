<div class="header">
	<div class="logo">
		<h1>
			<a href="#">Beykent</a>
			<span>KANTİNİ</span>
		</h1>
	</div>

	<?php
		if (isset($_COOKIE['guest'])) {
		$guest_username = 'misafir'.$_COOKIE['guest'];
		} else {
		$a = rand(1000, 100000);
		setcookie('guest', $a, time()+3600, '/');
		$guest_username = 'misafir'.$a;
		}
	?>

	{{ Form::open(array('action' => 'PostsController@SendPost')) }}
	<div class="dedikod-area">
		@if(!Sentry::check())
			{{ Form::textarea('post', null, ['placeholder' => $guest_username.' olarak dedikodla!']) }}
		@else 
			{{ Form::textarea('post', null, ['placeholder' => Sentry::getUser()->username.' olarak dedikodla!']) }}
		@endif
		<div class="bottom-bar">
			<div class="left">
				<span class="bar-button selected">Dedikodla!</span>
				<span class="bar-button" data-lightbox="lightbox/ticket.html" data-lightboxtitle="Etkinlik Olustur">Etkinlik Olustur</span>
			</div>
			<div class="right">
				@if(!Sentry::check())
					{{ Form::hidden('member', 0) }}
					{{ Form::hidden('username', $guest_username) }}
					{{ Form::hidden('gender', '') }}
					<span name="male" class="gender male bar-button"></span>
					<span name="female" class="gender female bar-button"></span>
				@else 
					{{ Form::hidden('username', Sentry::getUser()->username) }}
					{{ Form::hidden('gender', Sentry::getUser()->gender) }}
					{{ Form::hidden('member', 1) }}
				@endif
				<span class="send">
					Shift + Enter &nbsp;
					{{ Form::submit('GÖNDER', ['class' => 'button green sm'])}}
				</span>
			</div>
		</div>
	</div>
	{{ Form::close() }}

</div>