@extends('layouts.master')

@section('content')

	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif
	
	@include('layouts.send-post')

	@foreach($posts as $post)
		
		@if($post->type == '0')

		<?php 
			$post_id = $post->id;
			$likes = Like::where('post_id', '=', $post_id )->get();
			$comments = Comment::where('post_id', '=', $post_id )->get();
			$comments_count = $comments->count();
			$likes_count = $likes->count();
		?>
			<p>
				{{ $post->post }} | <a href="{{ URL::action('show.post', $post->id) }}">Yorum yaz</a> <br>
				{{ $post->gender }} | 
				
				@if($post->member == 1)
					<a href="{{ URL::action('show.profile', $post->username) }}">{{ $post->username }}</a> | Beğeni({{ $likes_count }}) | Yorum ({{ $comments_count }})
				@else 
					{{ $post->username }} | Beğeni({{ $likes_count }}) | Yorum ({{ $comments_count }})
				@endif
				
				@if(Sentry::check())
					@if(Like::where('post_id', $post->id)->where('liker', Sentry::getUser()->username)->count()>0)
						{{ 'ok' }}
					@else
						{{ Form::open(array('action' => 'LikesController@Like')) }}
						
						{{ Form::hidden('liker', Sentry::getUser()->username) }}
						{{ Form::hidden('post_id', $post->id) }}

						{{ Form::submit('like') }}

						{{ Form::close() }}
					@endif
				@else
					@if(Like::where('post_id', $post->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
						{{ 'ok' }}
					@else
						{{ Form::open(array('action' => 'LikesController@GuestLike')) }}

						{{ Form::hidden('post_id', $post->id) }}
						
						{{ Form::submit('like') }}

						{{ Form::close() }}
					@endif
				@endif
			</p>
			<hr>
		@endif

		@if($post->type == '1')
			{{ 'Etkinlik' }} | <a href="{{ URL::action('show.organization', $post->id) }}">Yorum yaz</a>
		@endif
	@endforeach
@stop