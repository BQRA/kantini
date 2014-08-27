<div class="avatar">
	@if(empty($user))
		{{ HTML::image('/Avatars/guest-avatar.png') }}
	@endif

	@if(!empty($user))
		@if($user->profile->avatar == 'guest')
			{{ HTML::image('/Avatars/guest-avatar.png') }}
		@else
			{{ HTML::image('/Avatars/'.$dummy->username.'.jpg') }}
		@endif
	@endif
</div>