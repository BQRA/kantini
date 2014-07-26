@extends('layouts.master')

@section('content')
	<p><a href="{{ URL::action('show.profile', $user->username) }}">{{ $user->username }}</a> kullanıcısının tüm gönderileri</p>

	@foreach($posts_all as $posts)
		<li>{{ $posts->post }} => <a href="{{ URL::action('show.post', $posts->id) }}">Oku</a></li>
	@endforeach
@stop