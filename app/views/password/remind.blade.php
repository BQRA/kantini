@extends('layouts.master')

@section('content')
<div class="blank-page">
	<h2>Şifremi Unuttum</h2>

	{{ Form::open(['class' => 'form']) }}

	<div class="row">
		<div class="col-sm-4 title">
			Eposta
		</div>
		<div class="col-sm-8">
			{{ Form::email('email') }}		
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