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

@if(!Sentry::check())
	{{ Form::hidden('member', 0) }}
	
	{{  $guest_username.' olarak gönderi yapıyorsunuz' }}
	{{ Form::hidden('username', $guest_username) }}

	@if($errors->has('username'))
		{{ $errors->first('username') }}
	@endif <br>

	{{ Form::label('gender', 'Cinsiyet') }}
	{{ Form::select('gender', array(
								null 	 => 'Seç',
								'male' 	 => 'Erkek',
								'female' => 'Kız'
							)) }} 
	@if($errors->has('gender'))
		{{ $errors->first('gender') }}
	@endif <br>
@else 
	{{ Form::hidden('username', Sentry::getUser()->username) }}
	{{ Form::hidden('gender', Sentry::getUser()->gender) }}
	{{ Form::hidden('member', 1) }}
@endif

{{ Form::label('post', 'Gönderi') }} <br>
{{ Form::textarea('post') }}

	@if($errors->has('post'))
		{{ $errors->first('post') }}
	@endif <br>

{{ Form::submit() }}

{{ Form::close() }}

<hr>