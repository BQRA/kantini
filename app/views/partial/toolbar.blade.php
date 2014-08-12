<div class="toolbar">
	<div class="left">
		@if($post->member == 1)
			<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
				{{ $post->username }}
			</a>
		@else 
			<span class="username">
				{{ $post->username }}
			</span>
		@endif
			<span class="date"><a href="{{ URL::action('show.post', $post->id) }}">{{date('d.m.Y',strtotime($post->created_at))}}</a></span>
	</div>
			
	<div class="right">
		<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post->id }} #giveComments">{{ $comments->count() }}</span>
		@if(Sentry::check())
			@if(!Like::where('post_id', $post->id)->where('liker', Sentry::getUser()->username)->count()>0)
			<span class="like">{{ $likes->count() }}</span>
			{{ Form::open(['action' => 'LikesController@Like']) }}
			{{ Form::hidden('post_type', $post->type) }}
			@else
			<span class="like selected">{{ $likes->count() }}</span>
			{{ Form::open(['action' => 'LikesController@Dislike']) }}
			@endif
		@else
			@if(!Like::where('post_id', $post->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
			<span class="like">{{ $likes->count() }}</span>
			{{ Form::open(['action' => 'LikesController@GuestLike']) }}
			{{ Form::hidden('post_type', $post->type) }}
			@else 
			<span class="like selected">{{ $likes->count() }}</span>
			{{ Form::open(['action' => 'LikesController@GuestDislike']) }}
			@endif
		@endif
		{{ Form::hidden('post_id', $post->id) }}
		{{ Form::close() }}
		<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post->id }} #giveComments">Yorum Yaz</span>		
	</div>
</div>