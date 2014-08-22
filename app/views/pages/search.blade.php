@extends('layouts.master')

@section('content')
	@if($posts->count())
		<div class="special-list-title">
			aranan <strong><?php echo $_GET['q'] ?></strong> kelimesi ile ilgili bulunan <strong>{{$posts->count()}}</strong> sonuç gösteriliyor.
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
		
		<div class="dedikod {{ $dummy->gender }}">
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
	@else
		<div class="blank-page">
			<h2>Sonuç bununamadı...</h2>
			<p class="text-center">Arama kelimenizi kısaltıp sonuç yelpazenizi genisletebilirsiniz.</p>
		</div>
	@endif
@stop
