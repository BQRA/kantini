@extends('layouts.master')

@section('content')
	@if($posts->count())
		<div class="special-list-title">
			aranan <strong><?php echo $_GET['q'] ?></strong> kelimesi ile ilgili bulunan <strong>{{$posts->count()}}</strong> sonuç gösteriliyor.
		</div>

		<div class="dedikods">
		@foreach($posts as $post)
		<?php 
			$user = User::whereUsername($post->username)->first(); 
			$comments = Comment::where('post_id', '=', $post->id)->get();
		?>
		
		<div class="dedikod {{ $post->gender }}">
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
						<span class="date"><a href="{{ URL::action('show.post', $post->id) }}">{{date('d.m.Y',strtotime($post->created_at))}}</a></span>
				</div>
						
				<div class="right">
					<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post->id }} #giveComments">{{$comments->count()}}</span>
					<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post->id }} #giveComments">Yorum Yaz</span>
				</div>
			</div>

			<div class="clear"></div>

			<div class="load-comments"></div>
		</div>
		@endforeach
		</div>
	@else
		<div class="blank-page">
			<h2>Sonuç bununamadı...</h2>
			<p class="text-center">Arama kelimenizi kısaltıp sonuç yelpazenizi genisletebilirsiniz.</p>
		</div>
	@endif
@stop
