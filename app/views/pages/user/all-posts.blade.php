@extends('layouts.master')

@section('content')

	<p><b><a href="{{ URL::action('show-profile', $user->username) }}">{{ $user->username }}</a></b> kullanıcısının tüm gönderileri</p>

	@if($posts_all->count())
		@foreach($posts_all as $posts)
			<li>{{ $posts->post }} => <a href="{{ URL::action('post/{id}', $posts->id) }}">Oku</a></li>
		@endforeach
	@endif
@stop