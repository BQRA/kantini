@extends('layouts.master')

@section('content')
<div class='row'>
	<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
		<fieldset>
			<legend>Kontak</legend>
				{{ Form::open(['route' => 'contact-us', 'class' => 'form-horizontal']) }}
				
				<div class='form-group'>
				{{ Form::label('fullname', 'Ad', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					{{ Form::input('text', 'fullname', null, ['class' => 'form-control', 'placeholder' => 'Ad ve Soyad']) }}
						<p class='text-danger'>
							@if($errors->has('fullname'))
					    	{{ $errors->first('fullname') }}
							@endif
						</p>
					</div>
				</div>
				
				<div class='form-group'>
				{{ Form::label('email', 'Eposta', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label']) }}
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					{{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => 'Eposta']) }}
						<p class='text-danger'>
							@if($errors->has('email'))
					    	{{ $errors->first('email') }}
							@endif
						</p>
					</div>
				</div>

				<div class='form-group'>
				{{ Form::label('subject', 'Konu', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label'])}}
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					{{ Form::select('subject', [null => 'Seç', 'Şikayet' => 'Şikayet', 'Reklam' => 'Reklam', 'İş' => 'İş', 'Tebrik' => 'Tebrik'], null, ['class' => 'form-control']) }}
						<p class='text-danger'>
								@if($errors->has('subject'))
						    	{{ $errors->first('subject') }}
								@endif
							</p>
						</div>
				</div>
				
				<div class='form-group'>
				{{ Form::label('message', 'Mesaj', ['class' => 'col-xs-1 col-sm-2 col-md-2 col-lg-2 control-label'])}}
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					{{ Form::textarea('message', null, ['size' => '30x5', 'class' => 'form-control']) }}
						<p class='text-danger'>
							@if($errors->has('message'))
					    	{{ $errors->first('message') }}
							@endif
						</p>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-md-4 col-md-offset-2'>
					{{ Form::submit('Gönder!', ['class' => 'btn btn-primary']) }}
					</div>
				<div class='form-group'>
				
				{{ Form::close() }}
			<br>
		</fieldset>
	</div>
</div>
@stop