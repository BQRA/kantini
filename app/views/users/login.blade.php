@extends('layouts.master')

@section('content')
	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif

	<p>Giriş</p>

	{{ Form::open(array('route' => 'login')) }}
	
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

	{{ Form::submit() }}

	{{ Form::close() }}
@stop