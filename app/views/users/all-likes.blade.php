@extends('layouts.master')

@section('content')
	<p><a href="{{ URL::action('show.profile', $user->username) }}">{{ $user->username }}</a> kullanıcısının tüm beğenileri</p>

	@foreach($likes as $like)
		<li>{{ $like->post->post }} => <a href="{{ URL::action('show.post', $like->post->id) }}">Oku</a></li>
	@endforeach
@stop
