@extends('layouts.master')

@section('content')
@include('layouts.index-errors')
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<fieldset>
			<legend>Giriş Yap</legend>
				{{ Form::open(['route' => 'user-login', 'class' => 'form-horizontal']) }}
				
				<div class="form-group">
				{{ Form::label('email', 'Eposta', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => 'Eposta']) }}
						@if($errors->has('email'))
					    <p class="text-danger">{{ $errors->first("email") }}</p>
						@endif

						@if(Session::has('message-1'))
						<p class="text-danger">{{ Session::get('message-1') }}</p>
						@endif
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('password', 'Şifre', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Şifre']) }}
					@if($errors->has('password'))
					<p class="text-danger">{{ $errors->first("password") }}</p>
					@endif

					@if(Session::has('message-2'))
						<p class="text-danger">{{ Session::get('message-2') }}</p>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4 col-md-offset-2">
					{{ Form::submit('Gönder!', ['class' => 'btn btn-primary']) }}
					</div>
				<div class="form-group">
				
				{{ Form::close() }}
			<br>
		</fieldset>
	</div>
</div>
@stop