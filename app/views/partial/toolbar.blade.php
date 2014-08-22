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
	<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">Yorum Yaz</span>
	<span class="like">{{$up->count() - $down->count()}}</span>
</div>