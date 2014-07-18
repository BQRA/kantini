@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<fieldset>
			<legend>Etkinlik oluştur</legend>
				{{ Form::open(
					[	'action' => ['UserController@postCreateOrganization',  $user->username],
						'class' => 'form-horizontal' 
					]) }}
				
				<div class="form-group">
				{{ Form::label('organization-name', 'Etkinlik adı', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('text', 'organization-name', null, ['class' => 'form-control', 'placeholder' => 'Etkinlik adı']) }}
						<p class="text-danger">
							@if($errors->has('organization-name'))
					    	{{ $errors->first("organization-name") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('organization-date', 'Tarih', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('datetime-local', 'organization-date', null, ['class' => 'form-control', 'placeholder' => 'Etkinlik tarihi']) }}
						<p class="text-danger">
							@if($errors->has('organization-date'))
					    	{{ $errors->first("organization-date") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('organization-place', 'Mekan', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('text', 'organization-place', null, ['class' => 'form-control', 'placeholder' => 'Etkinlik mekanı']) }}
						<p class="text-danger">
							@if($errors->has('organization-place'))
					    	{{ $errors->first("organization-place") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('organization-auth', 'Yetkili kişi', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('text', 'organization-auth', null, ['class' => 'form-control', 'placeholder' => 'Yetkili kişi']) }}
						<p class="text-danger">
							@if($errors->has('organization-auth'))
					    	{{ $errors->first("organization-auth") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('organization-auth-contact', 'İletişim', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('text', 'organization-auth-contact', null, ['class' => 'form-control', 'placeholder' => 'İletişim']) }}
						<p class="text-danger">
							@if($errors->has('organization-auth-contact'))
					    	{{ $errors->first("organization-auth-contact") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
				{{ Form::label('organization-price', 'Ücret', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::input('text', 'organization-price', null, ['class' => 'form-control', 'placeholder' => 'Ücret']) }}
						<p class="text-danger">
							@if($errors->has('organization-price'))
					    	{{ $errors->first("organization-price") }}
							@endif
						</p>
					</div>
				</div>
				
				<div class="form-group">
				{{ Form::label('organization-message', 'Açıklama', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label'])}}
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::textarea('organization-message', null, ['size' => '30x5', 'class' => 'form-control']) }}
						<p class="text-danger">
							@if($errors->has('organization-message'))
					    	{{ $errors->first("organization-message") }}
							@endif
						</p>
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