@extends('layouts.master')

@section('content')
	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif

	<p>Giriş</p>

	{{ Form::open(array('route' => 'login')) }}
	
	{{ Form::label('email', 'Eposta') }}
	{{ Form::Input('email', 'email') }} <br>

	{{ Form::label('password', 'Şifre') }}
	{{ Form::Input('password', 'password') }} <br>

	{{ Form::submit() }}

	{{ Form::close() }}
@stop