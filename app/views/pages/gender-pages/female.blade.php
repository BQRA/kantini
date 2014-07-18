@extends('layouts.master')

@section('content')
@include('layouts.index-errors')
	@if($posts->count())
		@foreach($posts as $post)
			<p>{{ $post->post }}</p>
				@if($post->gender === 'female')
					<span class="glyphicon glyphicon-star"></span>
				@else
					<span class="glyphicon glyphicon-star-empty"></span>
				@endif

				@if($post->member === 1)
					<b><a href="{{ URL::action('show-profile', $post->username) }}">{{ $post->username }}</a> - </b> 
				@else 
					{{ $post->username }} - 
				@endif
					<a href="{{ URL::action('post/{id}', $post->id) }}">Yorum yaz</a> | 
						(<?php 

							$post_id = $post->id;
							$comments = Comment::where('post_id', '=', $post_id )->get();
							$comment_post_count = $comments->count();
							echo $comment_post_count;

						?>) | Like
		@endforeach
	@endif
@stop