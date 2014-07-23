@extends('layouts.master')

@section('content')
<?php
	if (isset($_COOKIE['guest'])) {
	$guest_username = 'misafir'.$_COOKIE['guest'];
	} else {
	$a = rand();
	setcookie('guest', $a, time()+3600);
	$guest_username = 'misafir'.$a;
	}
?>
	<p>
		{{ $post->post }} <br>
		{{ $post->gender }} | 
			
			@if($post->member == 1)
				<a href="{{ URL::action('show.profile', $post->username) }}">{{ $post->username }}</a> |
			@else 
				{{ $post->username }} |
			@endif
			{{ $post->created_at }}
	</p>

	<hr>
	
	{{ Form::open(array('action' => 'PostsController@SendComment')) }}

		{{ Form::hidden('post_id', $post->id) }}
	
	@if(!Sentry::check())
		{{ Form::hidden('member', 0) }}

		{{  $guest_username.' olarak gönderi yapıyorsunuz' }}
		{{ Form::hidden('commenter', $guest_username) }} <br>

		{{ Form::label('gender', 'Cinsiyet') }}
		{{ Form::select('gender', array(
									null 	 => 'Seç',
									'male' 	 => 'Erkek',
									'female' => 'Kız'
								)) }} 
		@if($errors->has('gender'))
			{{ $errors->first('gender') }}
		@endif <br>
	@else
		{{ Form::hidden('commenter', Sentry::getUser()->username) }}
		{{ Form::hidden('gender', Sentry::getUser()->gender) }}
		{{ Form::hidden('member', 1) }}
	@endif

		{{ Form::label('comment', 'Yorum') }} <br>
		{{ Form::textarea('comment') }}

			@if($errors->has('comment'))
				{{ $errors->first('comment') }}
			@endif <br>

	{{ Form::submit() }}

	{{ Form::close() }}

	<hr>

	@foreach($comments as $comment)
		<p>
			{{ $comment->comment }} <br>
			{{ $comment->gender }} | 

			@if($comment->member == 1)
				<a href="{{ URL::action('show.profile', $comment->commenter) }}">{{ $comment->commenter }}</a> |
			@else 
				{{ $comment->commenter }} |
			@endif
			{{ $comment->created_at }}
		</p>
	@endforeach
@stop