@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<fieldset>
			<legend>Kayıt Ol</legend>
				{{ Form::open(['route' => 'user-register', 'class' => 'form-horizontal']) }}
				
				<div class="form-group">
				{{ Form::label('username', 'Kullanıcı Adı', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('text', 'username', null, ['class' => 'form-control', 'placeholder' => 'Kullanıcı Adı']) }}
						<p class="text-danger">
							@if($errors->has('username'))
					    	{{ $errors->first("username") }}
							@endif
						</p>
					</div>
				</div>
				
				<div class="form-group">
				{{ Form::label('email', 'Eposta', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => 'Eposta']) }}
						<p class="text-danger">
							@if($errors->has('email'))
					    	{{ $errors->first("email") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('password', 'Şifre', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Şifre']) }}
						<p class="text-danger">
							@if($errors->has('password'))
					    	{{ $errors->first("password") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('password_again', 'Şifre Tekrar', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('password', 'password_again', null, ['class' => 'form-control', 'placeholder' => 'Şifre Tekrar']) }}
						<p class="text-danger">
							@if($errors->has('password_again'))
					    	{{ $errors->first("password_again") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('school', 'Okul', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label'])}}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::select('school', [null => 'Seç', '1' => 'Beykent Üniversitesi', '2' => 'Bahçeşehir Üniversitesi'], null, ['class' => 'form-control']) }}
						<p class="text-danger">
								@if($errors->has('school'))
						    	{{ $errors->first("school") }}
								@endif
							</p>
						</div>
				</div>

				<div class="form-group">
				{{ Form::label('gender', 'Cinsiyet', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label'])}}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::select('gender', [null => 'Seç', 'male' => 'Erkek', 'female' => 'Kız'], null, ['class' => 'form-control']) }}
						<p class="text-danger">
								@if($errors->has('gender'))
						    	{{ $errors->first("gender") }}
								@endif
							</p>
						</div>
				</div>

				<hr>

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