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
		$post_id 	= $post->id;
		$user 		= User::whereUsername($post->username)->first(); 
		$comments 	= Comment::where('post_id', '=', $post_id)->get();
		$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
	?>
		<div class="dedikod {{$post->gender}}">
		{{-- Main Page Avatar --}}
			<div class="avatar">
				@if(empty($user))
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if(!empty($user))
					@if($user->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
						{{ HTML::image('/Avatars/'.$post->username.'.jpg') }}
					@endif
				@endif
			</div>
		{{-- Main Page Avatar --}}
				
			<div class="content">
				@if($post->type == 'dedikod')
					{{ $post->dedikod }}
				@endif
			</div>
				
			<div class="toolbar">
				<div class="left">
					@if(!empty($user))
						<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
							{{ $post->username }}
						</a>
					@else 
						<span class="username">{{ $post->username }}</span>
						@endif
						<span class="date"><a href="{{ URL::action('show.post', $post_id) }}">{{date('d.m.Y',strtotime($post->created_at))}}</a></span>
				</div>
						
				<div class="right">
					<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">{{$comments->count()}}</span>
					<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">Yorum Yaz</span>
					<span class="like">{{$up->count() - $down->count()}}</span>
				</div>
			</div>
				@include('partial.rating')
				
			<div class="clear"></div>
			<div class="load-comments"></div>
		</div>
	@endforeach
</div>
@stop
