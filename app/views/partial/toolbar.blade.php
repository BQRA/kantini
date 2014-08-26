<div class="left">
	@if(!empty($user))
		<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
		{{ $dummy->username }}
		</a>
	@else 
		<span class="username">{{ $dummy->username }}</span>
	@endif
						
	<span class="date"><a href="{{ URL::action('show.post', $post_id) }}">{{date('d.m.Y',strtotime($dummy->created_at))}}</a></span>
</div>
						
<div class="right">
	<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">{{$comments->count()}}</span>
	<!-- <span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">Yorum Yaz</span> -->
	<span class="like">
		{{ Form::open(['action' => 'RatesController@rate']) }}
		{{ Form::hidden('post_type', $dummy->type) }}
		{{ Form::hidden('post_id', $post_id) }}
		{{ Form::hidden('rate', 'up') }}
		@if(!Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)	
			<span class="up"></span>
		@elseif(Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
			<span class="up selected"></span>
		@endif
		{{ Form::close() }}
		{{ Form::open(['action' => 'RatesController@rate']) }}
		{{ Form::hidden('post_type', $dummy->type) }}
		{{ Form::hidden('post_id', $post_id) }}
		{{ Form::hidden('rate', 'down') }}
		@if(!Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)			
			<span class="down"></span>
		@elseif(Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
			<span class="down selected"></span>
		@endif
		{{ Form::close() }}
		<span class="result">{{$up->count() - $down->count()}}</span>
	</span>
</div>