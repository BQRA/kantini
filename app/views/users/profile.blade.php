@extends('layouts.master')

@section('content')

<div class="text-center">
	<div class="user-box {{ $user->gender }}" id="profileBox">
		<div class="avatar">
			@if($user->profile->avatar == 'guest')
				{{ HTML::image('/Avatars/guest-avatar.png') }}
			@else
				{{ HTML::image('/Avatars/'.$user->username.'.jpg') }}
			@endif
		</div>
		<div class="username">
			<span>{{ $user->username }}</span>
		</div>
		<div class="school">
			{{ $user->school }} Üniversitesi
		</div>
		<div class="custom-line"></div>
		<div class="row numbers">
			<div class="col-sm-4">
				<a href="#">
					@if($posts_all->count() > 0)
						<a href="{{ URL::action('show.users.all.posts', $user->username) }}">{{ $posts_all->count() }}</a>
					@else
						{{ $posts_all->count() }}
					@endif
					<small>Gönderi</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#">
					@if($comments_all->count() > 0)
						<a href="{{ URL::action('show.users.all.comments', $user->username) }}">{{ $comments_all->count() }}</a>
					@else
						{{ $comments_all->count() }}
					@endif
					<small>Yorum</small>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#">
					@if($likes->count() > 0)
						<a href="{{ URL::action('show.users.all.likes', $user->username) }}">{{ $likes->count() }}</a>
					@else
						{{ $likes->count() }}
					@endif
					<small>Beğeni</small>
				</a>
			</div>
		</div>
	</div>

	<!-- <i>Son görülme: {{ $user->last_login }}</i> <br>
	Eposta: {{ $user->email }} <br>
	Twitter: {{ $user->profile->twitter_username }} <br>
	Instagram: {{ $user->profile->instagram_username }} <br>
	Facebook: {{ $user->profile->facebook_username }}
	Ad: {{ $user->profile->full_name }} <br> -->

	{{--@if($orgs_all->count() > 0)
		Toplam organizasyon: {{ $orgs_all->count() }} &rarr; <a href="{{ URL::action('show.users.all.organizations', $user->username) }}">Tümü</a> <br>
	@else
		Toplam organizasyon: {{ $orgs_all->count() }} <br>
	@endif--}}
</div>
@stop