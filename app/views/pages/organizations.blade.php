@extends('layouts.master')

@section('content')
	@include('layouts.index-errors')

	<div class="row"> 
		@foreach($organizations as $organization)
			<div class="col-md-8">

			<b>Etkinlik Adı</b> <br> 
			{{ $organization->name }} => <a href="{{ URL::action('show-organization', $organization->id) }}">Detay</a> <br><br><br>

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