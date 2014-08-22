@extends('layouts.master')

@section('content')
<div class="filter-bar">
	<div class="left">
		<div class="select-box">
			<span class="text">Türe göre filtrele</span>
			<ul>
				<li><a href="#">Dedikodlar</a></li>
				<li><a href="#">Etkinlikler</a></li>
			</ul>
		</div>
	</div>

	<div class="right">
		<div class="select-box">
			<span class="text">İçeriğe göre filtrele</span>
			<ul>
				<li><a href="#">En yeniler</a></li>
				<li><a href="#">En eskiler</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="dedikods">
	@foreach($posts as $post)
	<?php
		$dummy 		= $post;
		$post_id 	= $dummy->id;
		$user 		= User::whereUsername($dummy->username)->first(); 
		$comments 	= Comment::where('post_id', '=', $post_id)->get();
		$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
	?>
		<div class="dedikod {{$dummy->gender}}">
		{{-- Main Page Avatar --}}
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
		{{-- Main Page Avatar --}}
			
			<div class="content">
				@include('partial.dummy')
			</div>
				
			<div class="toolbar">
				@include('partial.toolbar')
			</div>
			
			@include('partial.rating')
				
			<div class="clear"></div>
			<div class="load-comments"></div>
		</div>
	@endforeach
</div>
{{ $posts->links() }}
@stop
