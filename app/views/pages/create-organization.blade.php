@extends('layouts.master')

@section('content')
	{{ Form::open(array('action' => 'PostsController@CreateOrganization')) }}

	{{ Form::label('org_name', 'Organizasyon adı') }}
	{{ Form::Input('text', 'org_name') }}
		@if($errors->has('org_name'))
			{{ $errors->first('org_name') }}
		@endif <br>

	{{ Form::label('org_date', 'Tarih') }}
	{{ Form::Input('text', 'org_date') }}
		@if($errors->has('org_date'))
			{{ $errors->first('org_date') }}
		@endif <br>

	{{ Form::label('org_place', 'Mekan') }}
	{{ Form::Input('text', 'org_place') }}
		@if($errors->has('org_place'))
			{{ $errors->first('org_place') }}
		@endif <br>

	{{ Form::label('org_auth', 'Yetkili') }}
	{{ Form::Input('text', 'org_auth') }}
		@if($errors->has('org_auth'))
			{{ $errors->first('org_auth') }}
		@endif <br>

	{{ Form::label('org_auth_contact', 'Yetkili Tel') }}
	{{ Form::Input('text', 'org_auth_contact') }}
		@if($errors->has('org_auth_contact'))
			{{ $errors->first('org_auth_contact') }}
		@endif <br>

	{{ Form::label('org_price', 'Fiyat') }}
	{{ Form::Input('text', 'org_price') }}
		@if($errors->has('org_price'))
			{{ $errors->first('org_price') }}
		@endif <br>

	{{ Form::label('org_message', 'Mesaj') }}
	{{ Form::Input('text', 'org_message') }}
		@if($errors->has('org_message'))
			{{ $errors->first('org_message') }}
		@endif <br>

	{{ Form::submit() }}

	{{ Form::close() }}
@stop