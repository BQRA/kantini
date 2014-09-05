@extends('layouts.master')

@section('content')

<div class="text-center">
	<div class="user-box {{ $user->profile->gender }}" id="profileBox">
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
			{{ $user->profile->school }} Üniversitesi <br>
			{{--son görülme {{ date('H:i',strtotime($user->last_login)) }} --}}
		</div>
		<div class="custom-line"></div>
		<div class="row numbers">
			<div class="col-sm-4">
				@if($users_all_posts->count() > 0)
					<a href="{{ URL::action('user.all.posts', $user->username) }}">{{ $users_all_posts->count() }}</a>
				@else
					{{ $users_all_posts->count() }}
				@endif
				<small>Gönderi</small>
			</div>

			<div class="col-sm-4">
				@if($users_all_comments->count() > 0)
					<a href="{{ URL::action('user.all.comments', $user->username) }}">{{ $users_all_comments->count() }}</a>
				@else
					{{ $users_all_comments->count() }}
				@endif
				<small>Yorum</small>
			</div>

			<div class="col-sm-4">
				@if($users_all_votes->count() > 0)
					<a href="{{ URL::action('user.all.votes', $user->username) }}">{{ $users_all_votes->count() }}</a>
				@else
					{{ $users_all_votes->count() }}
				@endif
				<small>Yorum</small>
			</div>

		</div>
	</div>
</div>
@stop