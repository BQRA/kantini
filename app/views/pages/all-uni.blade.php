@extends('layouts.master')

@section('content')


<div id="allUni">
	<div class="blank-page">
		<div class="universities">
		<a href="{{ URL::route('home') }}">
			<span class="img">{{ HTML::image('Assets/images/logo.png', null) }}</span>
			<span class="name">Tüm Üniversiteler</span>
		</a>

		<?php $unis = School::all(); ?>
		@foreach($unis as $uni)
			<a class="{{$uni['school_name']}}" href="{{ URL::route('home') }}/uni/{{$uni['school_name']}}">
				<span class="img">{{ HTML::image('Assets/images/unis/logos/'.$uni['school_name'].'.png', null) }}</span>
				<span class="name">{{$uni['school_fullname']}}</span>	
			</a>
		@endforeach
		</div>
	</div>
</div>

@stop