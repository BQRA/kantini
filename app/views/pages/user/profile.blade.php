@extends('layouts.master')

@section('content')
	<h4>{{ $user->username }}</h4>
	
	{{ HTML::image("avatars/$user->username.jpg", "Profil", ["class" => "img-circle", "height" => "100px"]) }}
	
	<p>{{ $user->profile->first_name }} {{ $user->profile->last_name }}</p>
	<small>
		<p>Son görülme tarihi: {{ $user->last_login }}</p>
	</small>
	
	@if($user->profile->twitter_username !== '')
	<p><b>Twitter:</b> <a href="http://twitter.com/{{ $user->profile->twitter_username }}" target="_blank">{{ $user->profile->twitter_username }}</a></p>
	@endif
	
	@if($user->profile->instagram_username !== '')
	<p><b>Instagram:</b> <a href="http://instagram.com/{{ $user->profile->instagram_username }}" target="_blank">{{ $user->profile->instagram_username }}</a></p>
	@endif

	<p>Toplam yorum: 
	@if($comments_all->count() == 0)
		<b>Yorum yok</b></p>
	@else
	{{ $comments_all->count() }}
	=> <a href="{{ URL::action('users-all-comments', $user->username) }}">Tümü</a></p>
	@endif
	
	<p>Toplam gönderi: 
	@if($posts_all->count() == 0)
		<b>Gönderi yok</b></p>
	@else
	{{ $posts_all->count() }}
	=> <a href="{{ URL::action('users-all-posts', $user->username) }}">Tümü</a></p>
	@endif

	<p>Toplam etkinlik: 
	@if($organizations_all->count() == 0)
		<b>Etkinlik yok</b></p>
	@else
	{{ $organizations_all->count() }} 
	=> <a href="{{ URL::action('users-all-organizations', $user->username) }}">Tümü</a></p>
	@endif
	
	<hr>

	<h4>Son 3 yorum</h4>
	@if($comments->count())
		@foreach($comments as $comment)
		<li>
			{{ $comment->comment }} => {{ $comment->post_id }}
			<a href="{{ URL::action('post/{id}', $comment->post_id) }}">Oku</a>
		</li>
		@endforeach
	@else
		<p>Yorum yok!</p>
	@endif

	<hr>
	<h4>Son 3 konu</h4>
	@if($posts->count())
		@foreach($posts as $post)
		<li>
			{{ $post->post }} => {{ $post->id }}
			<a href="{{ URL::action('post/{id}', $post->id) }}">Oku</a>
		</li>
		@endforeach
	@else
		<p>Konu yok!</p>
	@endif
	<hr>
	
	@if($user->isCurrent())
		<a href="{{ URL::to('user/'.Sentry::getUser()->username).'/edit' }}">Düzenle</a>
		<a href="{{ URL::to('user/'.Sentry::getUser()->username).'/create-organization' }}">Etkinlik oluştur</a>
	@endif
@stop