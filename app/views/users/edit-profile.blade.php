@extends('layouts.master')

@section('content')

<div class="blank-page">
	<h2>Profil Düzenle</h2>

	{{ Form::model($user->profile, ['action' => ['UsersController@UpdateProfile', $user->username],'files' => true, 'class' => 'form']) }}
	
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