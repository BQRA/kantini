@extends('layouts.master')

@section('content')

<div class="blank-page">
	<h2>Profil Düzenle</h2>

	{{ Form::model($user->profile, ['action' => ['UsersController@updateProfile', $user->username],'files' => true, 'class' => 'form']) }}
	
	<div class="row">
		<div class="col-sm-4 title">
			Ad Soyad
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'full_name', null, ['placeholder'=>'Ad Soyad']) }}
			@if($errors->has('full_name'))
				<span class="error">{{ $errors->first('full_name') }}</span>
			@endif		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Twitter Kullanıcı Adı	
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'twitter', null, ['placeholder'=>'@username']) }}
			@if($errors->has('twitter'))
				<span class="error">{{ $errors->first('twitter') }}</span>
			@endif		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Instagram Kullanıcı Adı	
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'instagram', null, ['placeholder'=>'@username']) }}
			@if($errors->has('instagram'))
				<span class="error">{{ $errors->first('instagram') }}</span>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Facebook Kullanıcı Adı	
		</div>
		<div class="col-sm-8">
			{{ Form::Input('text', 'facebook', null, ['placeholder'=>'username']) }}
			@if($errors->has('facebook'))
				<span class="error">{{ $errors->first('facebook') }}</span>
			@endif		
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title">
			Profil Resmi
		</div>
		<div class="col-sm-8">
			{{ Form::file('image') }}
			@if($errors->has('image'))
				<span class="error">{{ $errors->first('image') }}</span>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 title"></div>
		<div class="col-sm-8">
			{{ Form::submit('GÜNCELLE', ['class' => 'button green']) }}
		</div>
	</div>
	{{ Form::close() }}

	<hr>
	
	<h2>Şifre Değiştir</h2>
	{{ Form::open(['action' => ['UsersController@changePassword', $user->username], 'class' => 'form']) }}

	<div class="row">
		<div class="col-sm-4 title">
			Şifre
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'current_password') }}
			@if($errors->has('current_password'))
				<span class="error">{{ $errors->first('current_password') }}</span>
			@endif	
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 title">
			Yeni Şifre
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'new_password') }}
			@if($errors->has('new_password'))
				<span class="error">{{ $errors->first('new_password') }}</span>
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 title">
			Yeni Şifre Tekrar
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'new_password_again') }}
			@if($errors->has('new_password_again'))
				<span class="error">{{ $errors->first('new_password_again') }}</span>
			@endif
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-4 title"></div>
		<div class="col-sm-8">
			{{ Form::submit('DEĞİŞTİR', ['class' => 'button green']) }}
		</div>
	</div>
	{{ Form::close() }}
</div>
@stop