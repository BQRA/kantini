@extends('layouts.master')

@section('content')
<div class="blank-page req">
	<h2>Şifremi Unuttum</h2>

	{{ Form::open(['class' => 'form']) }}

	<div class="row">
		<div class="col-sm-4 title">
			Eposta
		</div>
		<div class="col-sm-8">
			<div class="d-inlineblock">
			{{ Form::email('email', null, ['data-valid' => 'required', 'data-message' => 'Kantini.com"da Kayıtlı olan e-posta adresinizi giriniz']) }}		
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 title"></div>
		<div class="col-sm-8">
			{{ Form::submit('GÖNDER', ['class' => 'button green', 'data-validator']) }}
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