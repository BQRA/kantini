@if(Auth::check())
	@if(Flag::where('post_id', $post->id)->where('user_id', Auth::user()->id)->count()>0)
		<div class="dedikod {{$dummy->gender}} reported {{$dummy->school}}">
			<span class="reporting">Raporlandı</span>
	@else
		<div class="dedikod {{$dummy->gender}} {{$dummy->school}}">
	@endif
@else
<div class="dedikod {{$dummy->gender}} {{$dummy->school}}">
@endif
	<?php $uni = School::select('school_name', 'school_fullname')->where('school_name', $dummy->school)->first(); ?>
	<div class="uni tooltip" data-content="{{ $uni['school_fullname'] }}"></div>

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