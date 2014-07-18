@extends('layouts.master')

@section('content')

	<p><b><a href="{{ URL::action('show-profile', $user->username) }}">{{ $user->username }}</a></b> kullanıcısının tüm etkinlikleri</p>

	@if($organizations_all->count())
		@foreach($organizations_all as $organization)
			<li>{{ $organization->message }} => <a href="{{ URL::action('show-organization', $organization->id) }}">Oku</a></li>
		@endforeach
	@endif
@stop