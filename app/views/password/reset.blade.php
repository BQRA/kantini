@extends('layouts.master')

@section('content')
<div class="blank-page">
	<h2>Şifre Sıfırla</h2>

	{{ Form::open(['class' => 'form']) }}
	{{ Form::hidden('token', $token) }}

	<div class="row">
		<div class="col-sm-4 title">
			Eposta
		</div>
		<div class="col-sm-8">
			{{ Form::email('email') }}		
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 title">
			Şifre
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'password') }}		
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 title">
			Şifre Tekrar
		</div>
		<div class="col-sm-8">
			{{ Form::Input('password', 'password_confirmation') }}		
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 title"></div>
		<div class="col-sm-8">
			{{ Form::submit('GÖNDER', ['class' => 'button green']) }}
		</div>
	</div>

	{{ Form::close() }}
	@if(Session::has('error'))
		<p>{{Session::get('error')}}</p>
	@elseif(Session::has('status'))
		<p>{{Session::get('status')}}</p>
	@endif
</div>
@stop