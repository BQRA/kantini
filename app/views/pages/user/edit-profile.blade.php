@extends('layouts.master')

@section('content')

	@if (Session::has('message'))
		<div class="alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('message') }}
		</div>
	@endif
	
	<h1>Düzenle</h1>

	{{ Form::model($user->profile, ['action' => ['UserController@updateProfile', $user->username] ,'class' => 'form-horizontal']) }}
		
		<div class="form-group">
			{{ Form::label('first_name', 'Ad', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				{{ Form::input('first_name', 'first_name', null, ['class' => 'form-control', 'placeholder' => 'Ad']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('last_name', 'Soyad', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				{{ Form::input('last_name', 'last_name', null, ['class' => 'form-control', 'placeholder' => 'Soyad']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('twitter_username', 'Twitter', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				{{ Form::input('twitter_username', 'twitter_username', null, ['class' => 'form-control', 'placeholder' => 'Twitter kullanıcı adı']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('instagram_username', 'Instagram', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				{{ Form::input('instagram_username', 'instagram_username', null, ['class' => 'form-control', 'placeholder' => 'Instagram kullanıcı adı']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('bio', 'Bio', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label'])}}
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::textarea('bio', null, ['size' => '30x5', 'class' => 'form-control']) }}
				</div>
		</div>

		<div class="form-group">
			<div class="col-md-4 col-md-offset-2">
				{{ Form::submit('Gönder!', ['class' => 'btn btn-primary']) }}
			</div>
		<div class="form-group">

	{{ Form::close() }}
@stop