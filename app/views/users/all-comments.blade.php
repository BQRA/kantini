@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yorum yaptığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')

<div class="dedikods">
	@foreach($users_all_comments as $post)
	<?php
		$post_id 	= $post->post->id;
		$commenter 	= User::whereUsername($post->post->username)->first(); 
		$comments 	= Comment::where('post_id', '=', $post_id)->get();
		$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
	?>
		<div class="dedikod {{$post->post->gender}}">
			{{-- Commenter Avatar --}}
			<div class="avatar">
				@if(empty($commenter))
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if(!empty($commenter))
					@if($commenter->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
						{{ HTML::image('/Avatars/'.$post->post->username.'.jpg') }}
					@endif
				@endif
			</div>
			{{-- Commenter Avatar --}}

			<div class="content">
				{{$post->post->dedikod}}
			</div>

			<div class="toolbar">
				<div class="left">
					@if(!empty($commenter))
						<a class="username" data-lightbox="{{ URL::action('show.profile', $post->post->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
							{{ $post->post->username }}
						</a>
					@else 
						<span class="username">{{ $post->post->username }}</span>
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
