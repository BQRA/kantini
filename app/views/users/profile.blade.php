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

	<p>	
		@if($posts_all->count() > 0)
			Toplam gönderi: {{ $posts_all->count() }} &rarr; <a href="{{ URL::action('show.users.all.posts', $user->username) }}">Tümü</a> <br>
		@else
			Toplam gönderi: {{ $posts_all->count() }} <br>
		@endif

		@if($comments_all->count() > 0)
			Toplam yorum: {{ $comments_all->count() }} &rarr; <a href="{{ URL::action('show.users.all.comments', $user->username) }}">Tümü</a> <br>
		@else
			Toplam yorum: {{ $comments_all->count() }} <br>
		@endif

		@if($orgs_all->count() > 0)
			Toplam organizasyon: {{ $orgs_all->count() }} &rarr; <a href="{{ URL::action('show.users.all.organizations', $user->username) }}">Tümü</a> <br>
		@else
			Toplam organizasyon: {{ $orgs_all->count() }} <br>
		@endif

		@if($likes->count() > 0)
			Toplam beğeni: {{ $likes->count() }} &rarr; <a href="{{ URL::action('show.users.all.likes', $user->username) }}">Tümü</a> <br>
		@else
			Toplam beğeni: {{ $likes->count() }} <br>
		@endif
	</p>

	<hr>
	
	@if($posts->count() !== 0)
		<h4>Son 3 Gönderi</h5>
		@foreach($posts as $post)
		<li>
			{{ $post->post }} &rarr; <a href="{{ URL::action('show.post', $post->id) }}">Oku</a>
		</li>
		@endforeach
	@endif
	

	@if($comments->count() !== 0)
		<h4>Son 3 Yorum</h4>
		@foreach($comments as $comment)
		<li>
			{{ $comment->comment }} &rarr; <a href="{{ URL::action('show.post', $comment->post_id) }}">Oku</a>
		</li>
		@endforeach
	@endif
	
	@if($orgs->count() !== 0)
		<h4>Son 3 Etkinlik</h4>
		@foreach($orgs as $org)
		<li>
			{{ $org->org_name }} &rarr; <a href="{{ URL::action('show.organization', $org->id) }}">Oku</a>
		</li>
		@endforeach
	@endif
	
	<hr>
	@if($user->isCurrent())
		<a href="{{ URL::to('user/profile/'.Sentry::getUser()->username).'/edit' }}">Düzenle</a>
	@endif
@stop