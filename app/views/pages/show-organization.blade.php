@extends('layouts.master')

@section('content')
	<div class="row"> 
		@foreach($organizations as $organization)
			<div class="col-md-8">

			<b>Etkinlik Adı</b> <br> 
			{{ $organization->name }}<br><br><br>

			<b>Tarih:</b> {{ $organization->organization_date }}<br>
			<b>Mekan:</b> {{ $organization->place }}<br>
			<b>Yetkili Kişi:</b> {{ $organization->auth }}<br>
			<b>İletişim:</b> {{ $organization->auth_contact }}<br>
			<b>Ücret:</b> {{ $organization->price }}<br><br>

			<p>{{ $organization->message }}</p>
			<hr>
			</div>
		@endforeach		
	</div>
@stop