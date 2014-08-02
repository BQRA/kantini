@extends('layouts.master')

@section('title') - Kayıt Ol @stop

@section('content')

<div class="blank-page">
	<h2>Kayıt Ol</h2>

	{{ Form::open(['route' => 'register', 'files' => true, 'class' => 'form']) }}

	<div class="row">
		<div class="col-sm-4 title">
			Kullanıcı Adı
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'username') }}
			@if($errors->has('username'))
				<span class="error">{{ $errors->first('username') }}</span>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			E-posta
		</div>
		<div class="col-sm-8">
			{{ Form::Input('email', 'email') }} 
			@if($errors->has('email'))
				<span class="error">{{ $errors->first('email') }}</span>
			@endif 	
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Şifre
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'password') }}
			@if($errors->has('password'))
				<span class="error">{{ $errors->first('password') }}</span>
			@endif 
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Şifre Tekrar
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'password_again') }}
			@if($errors->has('password_again'))
				<span class="error">{{ $errors->first('password_again') }}</span>
			@endif 
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Okul
		</div>
		<div class="col-sm-8">
			{{ Form::select('school', [
				null => 'Seç', 
				'Beykent' => 'Beykent Üniversitesi', 
				'Bahçeşehir' => 'Bahçeşehir Üniversitesi'
			]) }}		
			@if($errors->has('school'))
				<span class="error">{{ $errors->first('school') }}</span>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Cinsiyet
		</div>
		<div class="col-sm-8">
			{{ Form::select('gender', [
				null => 'Seç',
				'male' => 'Erkek',
				'female' => 'Kız'
			]) }} 
			@if($errors->has('gender'))
				<span class="error">{{ $errors->first('gender') }}</span>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Ad Soyad
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'full_name') }}		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Twitter Kullanıcı Adı	
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'twitter_username', null, ['placeholder'=>'@username']) }}		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Instagram Kullanıcı Adı	
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'instagram_username', null, ['placeholder'=>'@username']) }}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Facebook Kullanıcı Adı	
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'facebook_username', null, ['placeholder'=>'username']) }}		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Profil Resmi
		</div>
		<div class="col-sm-8">
			{{ Form::file('image') }}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title"></div>
		<div class="col-sm-8">
			{{ Form::submit('KAYIT OL', ['class' => 'button green']) }}
		</div>
	</div>

	{{ Form::close() }}
</div>
@stop
