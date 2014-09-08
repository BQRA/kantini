<div class="avatar">
	@if($post->anonymous == 1)
		{{ HTML::image('/Avatars/guest-avatar.png') }}
	@else
		@if($user->profile->avatar == 'guest')
			{{ HTML::image('/Avatars/guest-avatar.png') }}
		@else
			{{ HTML::image('/Avatars/'.$post->username.'.jpg') }}
		@endif
	@endif
</div>