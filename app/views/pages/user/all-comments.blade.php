@extends('layouts.master')

@section('content')

	<p><b><a href="{{ URL::action('show-profile', $user->username) }}">{{ $user->username }}</a></b> kullanıcısının tüm yorumları</p>

	@if($comments_all->count())
		@foreach($comments_all as $comment)
			<li>{{ $comment->post->post }} => <a href="{{ URL::action('post/{id}', $comment->post_id) }}">Oku</a></li>
		@endforeach
	@endif
@stop