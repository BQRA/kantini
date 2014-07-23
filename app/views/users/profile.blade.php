@extends('layouts.master')

@section('content')
	<p>Profil</p>

	<p>
		Kullanıcı adı: {{ $user->username }} <i>Son görülme: {{ $user->last_login }}</i> <br>
		Eposta: {{ $user->email }} <br>
		Okul: {{ $user->school }} Üniversitesi <br>
		Cinsiyet: {{ $user->gender }}
	</p>

	<p>
		Twitter: {{ $user->profile->twitter_username }} <br>
		Instagram: {{ $user->profile->instagram_username }} <br>
		Facebook: {{ $user->profile->facebook_username }}
	</p>

	<p>
		Ad: {{ $user->profile->full_name }} <br>
		Bio: {{ $user->profile->bio }}
	</p>

	<hr>

	<h4>Son 3 Gönderi</h5>
		@foreach($posts as $post)
		<li>
			{{ $post->post }} &rarr; <a href="{{ URL::action('show.post', $post->id) }}">Oku</a>
		</li>
		@endforeach
	
	<h4>Son 3 Yorum</h4>
		@foreach($comments as $comment)
		<li>
			{{ $comment->comment }} &rarr; <a href="{{ URL::action('show.post', $comment->post_id) }}">Oku</a>
		</li>
		@endforeach

	<hr>
	@if($user->isCurrent())
		<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username).'/edit' }}">Düzenle</a>
	@endif
@stop