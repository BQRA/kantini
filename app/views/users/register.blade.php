@extends('layouts.master')

@section('content')
	<p>Kayıt</p>

	{{ Form::open(array('route' => 'register', 'files' => true)) }}

	{{ Form::label('username', 'Kullanıcı adı') }}
	{{ Form::Input('text', 'username') }}
		@if($errors->has('username'))
			{{ $errors->first('username') }}
		@endif <br>

	{{ Form::label('email', 'Eposta') }}
	{{ Form::Input('email', 'email') }} 
		@if($errors->has('email'))
			{{ $errors->first('email') }}
		@endif <br>

	{{ Form::label('password', 'Şifre') }}
	{{ Form::Input('password', 'password') }}
		@if($errors->has('password'))
			{{ $errors->first('password') }}
		@endif <br>

	{{ Form::label('password_again', 'Şifre Tekrar') }}
	{{ Form::Input('password', 'password_again') }}
		@if($errors->has('password_again'))
			{{ $errors->first('password_again') }}
		@endif <br>

	{{ Form::label('school', 'Okul') }}
	{{ Form::select('school', array(
								null => 'Seç', 
								'Beykent' => 'Beykent Üniversitesi', 
								'Bahçeşehir' => 'Bahçeşehir Üniversitesi'
							)) }}
		@if($errors->has('school'))
			{{ $errors->first('school') }}
		@endif <br>

	{{ Form::label('gender', 'Cinsiyet') }}
	{{ Form::select('gender', array(
								null => 'Seç',
								'male' => 'Erkek',
								'female' => 'Kız'
							)) }} 
		@if($errors->has('gender'))
			{{ $errors->first('gender') }}
		@endif <br> <hr>
	
	{{ Form::label('full_name', 'Ad ve Soyad') }}
	{{ Form::Input('text', 'full_name') }} <br>

	{{ Form::label('twitter_username', 'Twitter') }}
	{{ Form::Input('text', 'twitter_username') }} <br>

	{{ Form::label('instagram_username', 'Instagram') }}
	{{ Form::Input('text', 'instagram_username') }} <br>

	{{ Form::label('facebook_username', 'Facebook') }}
	{{ Form::Input('text', 'facebook_username') }} <br>

	{{ Form::file('image') }} <br>

	{{ Form::submit() }}

	{{ Form::close() }}
@stop