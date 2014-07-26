@extends('layouts.master')

@section('content')
	<p><a href="{{ URL::action('show.profile', $user->username) }}">{{ $user->username }}</a> kullanıcısının tüm yorumları</p>

	@foreach($comments_all as $comments)
		<li>{{ $comments->comment }} => <a href="{{ URL::action('show.post', $comments->post->id) }}">Oku</a></li>
	@endforeach
@stop