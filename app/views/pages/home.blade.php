@extends('layouts.master')

@section('content')

	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif
	
	<?php
		if (isset($_COOKIE['guest'])) {
		$guest_username = 'misafir'.$_COOKIE['guest'];
		} else {
		$a = rand(1000, 100000);
		setcookie('guest', $a, time()+3600, '/');
		$guest_username = 'misafir'.$a;
		}
	?>
	
	{{ Form::open(array('action' => 'PostsController@SendPost')) }}

		@if(!Sentry::check())
			{{ Form::hidden('member', 0) }}
	
			{{  $guest_username.' olarak gönderi yapıyorsunuz' }}
			{{ Form::hidden('username', $guest_username) }}

			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif <br>

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
			{{ Form::hidden('username', Sentry::getUser()->username) }}
			{{ Form::hidden('gender', Sentry::getUser()->gender) }}
			{{ Form::hidden('member', 1) }}
		@endif

			{{ Form::label('post', 'Gönderi') }} <br>
			{{ Form::textarea('post') }}

			@if($errors->has('post'))
				{{ $errors->first('post') }}
			@endif <br>

		{{ Form::submit() }}

	{{ Form::close() }}

	<hr>

	@foreach($posts as $post)
		
		@if($post->type == '0')

		<?php 
			$post_id 		= $post->id;
			$likes 			= Like::where('post_id', '=', $post_id )->get();
			$comments 		= Comment::where('post_id', '=', $post_id )->get();
			$comments_count = $comments->count();
			$likes_count 	= $likes->count();
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
						
						{{ Form::hidden('liker', $guest_username) }}
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
			<hr>
		@endif
	@endforeach
@stop