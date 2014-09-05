@extends('layouts.master')

@section('title') - Kayıt Ol @stop
@section('content')

<div class="blank-page req">
	<h2>Kayıt Ol</h2>

	{{ Form::open(['action' => 'UsersController@postRegister', 'files' => true, 'class' => 'form']) }}

	<div class="row">
		<div class="col-sm-4 title">
			Kullanıcı Adı
		</div>
		<div class="col-sm-8">
			<div class="d-inlineblock">
			{{ Form::Input('text', 'username', null, ['data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			E-posta
		</div>
		<div class="col-sm-8">
			<div class="d-inlineblock">
			{{ Form::Input('email', 'email', null, ['data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Şifre
		</div>
		<div class="col-sm-8">
			<div class="d-inlineblock">
			{{ Form::Input('password', 'password', null, ['data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
			</div>
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
			<div class="d-inlineblock">
			{{ Form::Input('password', 'password_again', null, ['data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
			</div>
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
			<div class="d-inlineblock">
			{{ Form::select('school', [
				null => 'Seç', 
				'Beykent' => 'Beykent Üniversitesi', 
				'Bahçeşehir' => 'Bahçeşehir Üniversitesi'
			], null, ['data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur', 'data-select' => '']) }}		
			</div>
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
			<div class="d-inlineblock">
			{{ Form::select('gender', [
				null => 'Seç',
				'male' => 'Erkek',
				'female' => 'Kız'
			], null, ['data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur', 'data-select' => '']) }} 
			</div>
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
			{{ Form::submit('KAYIT OL', ['class' => 'button green', 'data-validator']) }}
		</div>
	</div>

	{{ Form::close() }}
</div>
@stop
