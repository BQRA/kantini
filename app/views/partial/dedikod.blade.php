@if(Auth::check())
	@if(Flag::where('post_id', $post->id)->where('user_id', Auth::user()->id)->count()>0)
		<div class="dedikod {{$dummy->gender}} reported">
			<span class="reporting">Raporlandı</span>
	@else
		<div class="dedikod {{$dummy->gender}}">
	@endif
@endif
	@include('partial.avatar')
	
	<div class="content">
		@include('partial.dummy')
	</div>
	
	@include('partial.toolbar')
	
	<div class="clear"></div>

	<div class="load-comments">
		<div class="comments loading"><i></i></div>
	</div>
</div>