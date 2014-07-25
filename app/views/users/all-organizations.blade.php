@extends('layouts.master')

@section('content')
	<p><a href="{{ URL::action('show.profile', $user->username) }}">{{ $user->username }}</a> kullanıcısının tüm gönderileri</p>

	@foreach($orgs_all as $orgs)
		<li>{{ $orgs->org_name }} => <a href="{{ URL::action('show.organization', $orgs->id) }}">Oku</a></li>
	@endforeach
@stop